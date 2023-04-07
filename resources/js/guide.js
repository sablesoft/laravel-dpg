import { reactive } from 'vue';
import { isEmpty, isNumber } from "lodash/lang";

export const guide = reactive({
    tab: 'Info',
    projects : {},
    topics : {},
    notes : {},
    posts : {},
    links : {},
    projectsId : null,
    categoriesId : null,
    topicsId : null,
    postsId : null,
    notesId : null,
    isAddProject: false,
    isAddTopic: false,
    isAddPost: false,
    isAddNote: false,
    isAddLink: false,
    backLink: null,
    isReady: false,
    deleteAsk: null,
    _itemsIdFields : ['categoriesId', 'topicsId', 'postsId', 'notesId'],
    _isAddFields : ['isAddProject', 'isAddTopic', 'isAddPost', 'isAddNote', 'isAddLink'],
    init(config) {
        for (const [key, value] of Object.entries(config)) {
            let data = value.data ? value.data : value;
            if (isNumber(data) || !isEmpty(data)) {
                this[key] = data;
            }
        }
        this.isReady = true;
        console.log('GUIDE:', this);
    },
    getProject(id = null) {
        id = id ? id : this.projectsId;
        return id ? this.projects[id] : null;
    },
    getProjectNotes(id = null) {
        let project = this.getProject(id);
        if (!project) {
            return [];
        }
        let notes = {};
        let self = this;
        project.noteIds.forEach(function(id) {
           notes[id] = self.notes[id];
        });

        return notes;
    },
    getProjectTopics(id = null) {
        let project = this.getProject(id);
        if (!project) {
            return [];
        }
        let topics = {};
        let self = this;
        project.topicIds.forEach(function(id) {
            topics[id] = self.topics[id];
        });

        return topics;
    },
    getProjectPosts(id = null) {
        let project = this.getProject(id);
        if (!project) {
            return [];
        }
        let posts = {};
        let self = this;
        project.postIds.forEach(function(id) {
            posts[id] = self.posts[id];
        });

        return posts;
    },
    getPost(id = null) {
        id = id ? id : this.postsId;
        return id ? this.posts[id] : null;
    },
    getPostNotes(id = null) {
        let post = this.getPost(id);
        if (!post) {
            return [];
        }
        let notes = {};
        let self = this;
        post.noteIds.forEach(function(id) {
            notes[id] = self.notes[id];
        });

        return notes;
    },
    getPostLinks(id = null) {
        let post = this.getPost(id);
        if (!post) {
            return [];
        }
        let links = {};
        let self = this;
        post.linkIds.forEach(function(id) {
            links[id] = self.links[id];
        });

        return links;
    },
    getNoteLinks(id = null) {
        let note = this.getNote(id);
        if (!note) {
            return [];
        }
        let links = {};
        let self = this;
        note.linkIds.forEach(function(id) {
            links[id] = self.links[id];
        });

        return links;
    },
    getNote(id = null) {
        id = id ? id : this.notesId;
        return id ? this.notes[id] : null;
    },
    getProjectCategories(id = null) {
        let posts = this.getProjectPosts(id);
        if (isEmpty(posts)) {
            return {};
        }
        let categories = {};
        for (const [id, post] of Object.entries(posts)) {
            categories[post.categoryId] = this.getTopic(post.categoryId);
        }

        return categories;
    },
    getCategoryPosts(id = null) {
        id = id ? id : this.categoriesId;
        let topic = this.getTopic(id);
        if (!topic) {
            return [];
        }
        let self = this;
        let posts = {};
        topic.categoryPostIds.forEach(function(id) {
           posts[id] =  self.getPost(id);
        });

        return posts;
    },
    getTopic(id = null) {
        id = id ? id : this.topicsId;
        return id ? this.topics[id] : null;
    },
    getTopicField(field, id = null) {
        let topic = this.getTopic(id);
        return topic ? topic[field] : null;
    },
    getTopicProject(id = null, field = null) {
        let topic = this.getTopic(id);
        if (!topic || !topic.projectId) {
            return null;
        }
        let project = this.getProject(topic.projectId);
        if (!project) {
            return null;
        }

        return field ? project[field] : project;
    },
    request(routeName, post, callback) {
        axios.post(route(routeName), post)
            .then(response => callback(response))
            .catch(err => {
                console.error(err);
            });
    },
    askDeletion(item, entity = '') {
        this.deleteAsk = {
            item : item,
            entity : entity
        }
    },
    delete(item = null, entity = null) {
        entity = entity ? entity : this.deleteAsk.entity;
        item = item ? item : this.deleteAsk.item;
        if (entity === 'category') {
            return this.clearCategory(item);
        }
        let self = this;
        let id = item.id;
        this.request('guide.delete', {
           'table' : item.entity + 's',
           'id' : id
        }, function(res) {
            switch (item.entity) {
                case 'topic':
                    self.removeTopic(id);
                    break;
                case 'project':
                    self.removeProject(id);
                    break;
                case 'post':
                    self.removePost(id);
                    break;
                case 'note':
                    self.removeNote(id);
                    break;
                case 'link':
                    self.removeLink(id);
                    break;
                default:
                    break;
            }
            self.deleteAsk = null;
        });
    },
    clearCategory(item) {
        let self = this;
        item.categoryPostIds.forEach(function(id) {
            let post = self.getPost(id);
            console.log('Delete category post:', post);
            self.delete(post);
        });
    },
    removeProject(id) {
        let project = this.projects[id];
        console.log('Remove project:', project);
        let self = this;
        project.noteIds.forEach(function(id) {
            self.removeNote(id);
        });
        project.postIds.forEach(function(id) {
            self.removePost(id);
        });
        project.topicIds.forEach(function(id) {
            self.removeTopic(id);
        });
        if (this.projectsId && parseInt(this.projectsId) === parseInt(id)) {
            this.projectsId = null;
            this.tab = 'Info';
        }
        // pause for all staff deleting:
        setTimeout(function() {
            delete self.projects[id];
        }, 2000);
    },
    removeTopic(id) {
        let topic = this.topics[id];
        console.log('Remove topic:', topic);
        for (const [noteId, note] of Object.entries(this.notes)) {
            if (parseInt(note.topicId) === parseInt(id)) {
                this.removeNote(noteId);
            }
        }
        for (const [postId, post] of Object.entries(this.posts)) {
            if (parseInt(post.categoryId) === parseInt(id) ||
                parseInt(post.topicId) === parseInt(id)) {
                this.removePost(postId);
            }
        }
        // remove topic id from project:
        if (topic.projectId) {
            let project = this.getProject(topic.projectId);
            project.topicIds = this._removeFromIds(id, project.topicIds);
        }
        if (this.topicsId && parseInt(this.topicsId) === parseInt(id)) {
            this.topicsId = null;
        }
        if (this.categoriesId && parseInt(this.categoriesId) === parseInt(id)) {
            this.categoriesId = null;
            this.changeTab('Info');
        }
        let self = this;
        // pause for all staff deleting:
        setTimeout(function() {
            delete self.topics[id];
        }, 1000);
    },
    removePost(id) {
        let post = this.posts[id];
        console.log('Remove post:', post);
        // remove post id from project:
        let project = this.projects[post.projectId];
        project.postIds = this._removeFromIds(id, project.postIds);
        // remove post id from category:
        let category = this.topics[post.categoryId];
        category.categoryPostIds = this._removeFromIds(id, category.categoryPostIds);
        let self = this;
        // remove post notes:
        post.noteIds.forEach(function(id) {
            self.removeNote(parseInt(id));
        });
        // update current post id:
        if (this.postsId && parseInt(this.postsId) === parseInt(id)) {
            this.postsId = null;
        }
        // pause for notes deleting:
        setTimeout(function() {
            delete self.posts[id];
        }, 500);
    },
    removeNote(id) {
        let note = this.notes[id];
        // remove note id from project:
        if (note.projectId) {
            let project = this.projects[note.projectId];
            project.noteIds = this._removeFromIds(id, project.noteIds);
        }
        // remove note id from post:
        if (note.postId) {
            let post = this.posts[note.postId];
            post.noteIds = this._removeFromIds(id, post.noteIds);
        }
        if (this.notesId && parseInt(this.notesId) === parseInt(id)) {
            this.notesId = null;
        }
        delete this.notes[id];
    },
    removeLink(id) {
        // todo
    },
    updateField(table, field, value, id = null) {
        let currentIdField = table + 'Id';
        id = id ? id : this[currentIdField];
        if (!id) {
            throw new Error('Id for updating ' + table + ' not found!');
        }
        let item = this[table][id];
        if (!item) {
            throw new Error('Item of '+ table +' with id '+ id +' not found!');
        }
        this.request('guide.update', {
            table: table,
            id: id,
            field: field,
            value: value
        }, function(res) {
            if (res.data.success) {
                item[field] = value;
                item['updatedAt'] = res.data.updatedAt;
            } else {
                console.error('Update field problem', res);
            }
        });
    },
    createNote(form, item) {
        let self = this;
        let data = {
            content : form.content,
            topic_id : form.topicId,
        }
        data[item.entity + '_id'] = item.id;
        this.request('guide.create', {
            table: 'notes',
            data: data
        }, function(res) {
            if (res.status === 201) {
                let note = res.data.data;
                self.notes[note.id] = note;
                switch (item.entity) {
                    case 'project':
                        let project = self.getProject(item.id);
                        project.noteIds = self._addToIds(note.id, project.noteIds);
                        break;
                    case 'post':
                        let post = self.getPost(item.id);
                        post.noteIds = self._addToIds(note.id, post.noteIds);
                        break;
                    default:
                        break;
                }
            } else {
                console.error(res);
            }
            self.isAddNote = false;
        });
    },
    createPost(form) {
        let self = this;
        this.request('guide.create', {
            table: 'posts',
            data: {
                category_id : form.categoryId,
                topic_id : form.topicId,
                desc: form.desc,
                project_id: this.projectsId
            }
        }, function(res) {
            if (res.status === 201) {
                // save new post:
                let post = res.data.data;
                self.posts[post.id] = post;
                // add new post id to project:
                let project = self.getProject();
                project.postIds = self._addToIds(post.id, project.postIds);
                // add new post id to category:
                let category = self.getTopic(post.categoryId);
                category.categoryPostIds = self._addToIds(post.id, category.categoryPostIds);
                // update current category:
                self.categoriesId = post.categoryId;
            } else {
                console.error(res);
            }
            self.isAddPost = false;
        });
    },
    createTopic(form) {
        let self = this;
        this.request('guide.create', {
                table: 'topics',
                data : {
                    name : form.name,
                    desc : form.desc,
                    project_id : form.isGlobal ? null : this.projectsId
                }
            },
            function(res) {
            if (res.status === 201) {
                let topic = res.data.data;
                self.topics[topic.id] = topic;
                // add topic id to project:
                if (topic.projectId) {
                    let project = self.getProject(topic.projectId);
                    project.topicIds = self._addToIds(topic.id, project.topicIds);
                }
                // set current topic id:
                self.topicsId = topic.id;
            } else {
                console.error(res);
            }
            self.isAddTopic = false;
        });
    },
    createProject(form) {
        let self = this;
        this.request('guide.create', {
            table: 'projects',
            data : {
                name: form['name'],
                code: form['code']
            }
        }, function(res) {
            if (res.status === 201) {
                let project = res.data.data;
                self.projects[project.id] = project;
                self.projectsId = project.id;
            } else {
                console.error(res);
            }
            self.isAddProject = false;
        });
    },
    createLink(form, item) {
        let self = this;
        let data = {
            target_category_id : form.categoryId,
            target_post_id : form.postId,
            target_note_id : form.noteId,
        }
        data[item.entity + '_id'] = item.id;
        this.request('guide.create', {
            table: 'links',
            data: data
        }, function(res) {
            if (res.status === 201) {
                let link = res.data.data;
                self.links[link.id] = link;
                switch (item.entity) {
                    case 'note':
                        let note = self.getNote(item.id);
                        note.linkIds = self._addToIds(link.id, note.linkIds);
                        break;
                    case 'post':
                        let post = self.getPost(item.id);
                        post.linkIds = self._addToIds(link.id, post.linkIds);
                        break;
                    default:
                        break;
                }
            } else {
                console.error(res);
            }
            self.isAddLink = false;
        });
    },
    resetAdding() {
        let self = this;
        this._isAddFields.forEach(function(field) {
            self[field] = false;
        });
        if (this.tab === 'ProjectInfo' && !this.projectsId) {
            this.tab = 'Info';
        }
        if (this.tab === 'Category' && !this.categoriesId) {
            this.tab = 'Info';
        }
        if (this.tab === 'Topic') {
            this.tab = 'Info';
        }
    },
    resetSelect() {
        if (this.notesId) {
            this.notesId = null;
        } else if (this.postsId) {
            this.postsId = null;
        }
    },
    changeTab(tab) {
        this._setBackLink();
        this.tab = tab;
    },
    goTo(link, target) {
        this._setBackLink();
        this.tab = 'Category';
        this.categoriesId = link.targetCategoryId;
        if (target === 'category') {
            location.hash = "#" + 'category' + this.categoriesId;
            return;
        }
        this.postsId = link.targetPostId;
        if (target === 'post') {
            location.hash = "#" + 'post' + this.postsId;
            return;
        }
        this.notesId = link.targetNoteId;
        location.hash = "#" + 'note' + this.notesId;
    },
    goBack() {
        let self = this;
        this.tab = 'Category';
        ['categoriesId', 'postsId', 'notesId'].forEach(function(field) {
            self[field] = self.backLink[field];
        });
        setTimeout(function() {
            self.backLink = null;
            if (self.notesId) {
                location.hash = "#" + 'note' + self.notesId;
            } else if (self.postsId) {
                location.hash = "#" + 'post' + self.postsId;
            } else {
                location.hash = "#" + 'category' + self.categoriesId;
            }
        }, 100);
    },
    isActive(item, entity = '') {
        if (!item) {
            return false;
        }

        let idField = (entity === 'category') ?
            'categoriesId' : item.entity + 'sId';

        return parseInt(this[idField]) === parseInt(item.id);
    },
    isAdding(entity = null) {
        if (entity) {
            let field = 'isAdd' + entity.charAt(0).toUpperCase() + entity.slice(1);
            return this[field];
        }
        let self = this;
        let isAdd = false;
        this._isAddFields.forEach(function(field) {
            if (self[field]) {
                isAdd = true;
            }
        });

        return isAdd;
    },
    _removeFromIds(id, ids) {
        let idsCopy = ids;
        let index = idsCopy.indexOf(parseInt(id));
        if (index > -1) {
            idsCopy.splice(index, 1);
        } else {
            console.warn('ID not found in IDS!', id, idsCopy);
        }

        return idsCopy;
    },
    _addToIds(id, ids) {
        let idsCopy = ids;
        let index = idsCopy.indexOf(parseInt(id));
        if (index > -1) {
            console.warn('ID already in IDS!', id, idsCopy);
        } else {
            idsCopy.push(parseInt(id));
        }

        return idsCopy;
    },
    _setBackLink() {
        if (this.tab === 'Category' && this.categoriesId) {
            this.backLink = {
                categoriesId: this.categoriesId,
                postsId: this.postsId,
                notesId: this.notesId
            };
        }
        let self = this;
        this.resetAdding();
        this._itemsIdFields.forEach(function(field) {
           self[field] = null;
        });
    }
});
