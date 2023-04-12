import {reactive, toRaw} from 'vue';
import { isEmpty, isNumber } from "lodash/lang";

export const guide = reactive({
    tab: 'Info',
    projects : {},
    topics : {},
    posts : {},
    notes : {},
    links : {},
    projectsId : null,
    categoriesId : null,
    topicsId : null,
    postsId : null,
    notesId : null,
    linksId : null,
    projectAdding: false,
    topicAdding: false,
    postAdding: false,
    noteAdding: false,
    linkAdding: false,
    backLink: null,
    deleteAsk: null,
    isReady: false,
    draggable: false,
    _itemsIdFields : ['categoriesId', 'topicsId', 'postsId', 'notesId', 'linksId'],
    _addingFields : ['projectAdding', 'topicAdding', 'postAdding', 'noteAdding', 'linkAdding'],

    // ========== METHODS ===========

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

    // item getters:
    getItem(entity, id = null) {
        id = id ? id : this[entity + 'sId'];
        return id ? this[entity + 's'][id] : null;
    },
    getProject(id = null) {
        return this.getItem('project', id);
    },
    getTopic(id = null) {
        return this.getItem('topic', id);
    },
    getPost(id = null) {
        return this.getItem('post', id);
    },
    getNote(id = null) {
        return this.getItem('note', id);
    },
    getLink(id = null) {
        return this.getItem('link', id);
    },

    // relation getters:
    getRelation(entity, relationEntity, id = null) {
        let relationField = relationEntity + 'Id';
        let item = this.getItem(entity, id);
        if (!item || !item[relationField]) {
            return null;
        }

        return this.getItem(relationEntity, item[relationField]);
    },
    getTopicProject(id = null) {
        return this.getRelation('topic', 'project', id);
    },

    // relations getters:
    getRelations(entity, relationEntity, id = null, asArray = false) {
        let item = this.getItem(entity, id);
        if (!item) {
            return [];
        }
        let relations;
        let self = this;
        if (asArray) {
            relations = [];
            item[relationEntity + 'Ids'].forEach(function(id) {
                relations.push(self[relationEntity + 's'][id]);
            });
        } else {
            relations = {};
            item[relationEntity + 'Ids'].forEach(function(id) {
                relations[id] = self[relationEntity + 's'][id];
            });
        }

        return relations;
    },
    getProjectNotes(id = null) {
        let notes = this.getRelations('project', 'note', id, true);

        return this._sortItemsByNumber(notes);
    },
    getSortedTopics() {
        let topics = [];
        for (const [id, topic] of Object.entries(this.topics)) {
            topics.push(topic);
        }
        topics.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return topics;
    },
    getProjectTopics(id = null) {
        let topics = this.getRelations('project', 'topic', id, true);
        topics.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return topics;
    },
    getProjectPosts(id = null) {
        return this.getRelations('project', 'post', id);
    },
    getPostNotes(id = null) {
        let notes = this.getRelations('post', 'note', id, true);

        return this._sortItemsByNumber(notes);
    },
    getPostLinks(id = null) {
        let links = this.getRelations('post', 'link', id, true);

        return this._sortItemsByNumber(links);
    },
    getNoteLinks(id = null) {
        let links = this.getRelations('note', 'link', id, true);

        return this._sortItemsByNumber(links);
    },
    getTopicPosts(id = null) {
        return this.getRelations('topic', 'post', id);
    },
    getTopicNotes(id = null) {
        return this.getRelations('topic', 'note', id);
    },
    getTopicLinks(id = null) {
        return this.getRelations('topic', 'link', id);
    },

    getProjectCategories(id = null) {
        let posts = this.getProjectPosts(id);
        if (isEmpty(posts)) {
            return {};
        }
        let ids = {};
        let categories = [];
        for (const [id, post] of Object.entries(posts)) {
            if (!ids[post.categoryId]) {
                categories.push(this.getTopic(post.categoryId));
                ids[post.categoryId] = true;
            }
        }
        categories.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return categories;
    },
    getCategoryPosts(id = null) {
        id = id ? id : this.categoriesId;
        let topic = this.getTopic(id);
        if (!topic) {
            return [];
        }
        let self = this;
        let posts = [];
        topic.categoryPostIds.forEach(function(id) {
           posts.push(self.getPost(id));
        });

        return this._sortItemsByNumber(posts);
    },
    getGeneralTopics() {
        let topics = [];
        for (const [id, topic] of Object.entries(this.topics)) {
            if (!topic.projectId) {
                topics.push(topic);
            }
        }
        topics.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return topics;
    },
    isCategory(id = null) {
        id = id ? id : this.topicsId;
        for (const [postId, post] of Object.entries(this.posts)) {
            if (parseInt(post.categoryId) === parseInt(id)) {
                return true;
            }
        }
        return false;
    },

    // field getters:
    getField(entity, field, id = null) {
        let item = this.getItem(entity, id);
        return item ? item[field] : null;
    },
    getTopicField(field, id = null) {
        return this.getField('topic', field, id);
    },

    // requests:
    request(routeName, post, callback) {
        axios.post(route(routeName), post)
            .then(response => callback(response))
            .catch(err => {
                console.error(err);
            });
    },
    updateField(entity, field, value, id = null) {
        let self = this;
        let item = this.getItem(entity, id);
        if (!item) {
            throw new Error(entity +' with id '+ id +' not found!');
        }
        this.request('guide.update', {
            table: entity + 's',
            id: item.id,
            field: field,
            value: value
        }, function(res) {
            if (res.data.success) {
                if (field === 'number') {
                    self.updateNumber(item, res.data.result);
                } else {
                    item[field] = value;
                }
                item['updatedAt'] = res.data.updatedAt;
            } else {
                console.error('Update field problem', res);
            }
        });
    },
    updateNumber(item, list) {
        let self = this;
        let listField = item.entity + 's';
        list.forEach(function(item) {
            self[listField][item.id]['number'] = item.number;
        });
        this.draggable = false;
    },
    createNote(form, item) {
        let data = {
            text : form.text,
            topic_id : form.topicId,
        }
        data[item.entity + '_id'] = item.id;
        this.request('guide.create', {
            table: 'notes',
            data: data
        }, this._createCallback.bind(this));
    },
    createPost(form) {
        this.request('guide.create', {
            table: 'posts',
            data: {
                category_id : form.categoryId,
                topic_id : form.topicId,
                text: form.text,
                project_id: this.projectsId
            }
        }, this._createCallback.bind(this));
    },
    createTopic(form) {
        this.request('guide.create', {
                table: 'topics',
                data : {
                    name : form.name,
                    text : form.text,
                    project_id : form.isGlobal ? null : this.projectsId
                }
            }, this._createCallback.bind(this));
    },
    createProject(form) {
        console.log('create project!', form);
        this.request('guide.create', {
            table: 'projects',
            data : {
                name: form['name'],
                code: form['code'],
                text: form['text']
            }
        }, this._createCallback.bind(this));
    },
    createLink(form, item) {
        let data = {
            target_category_id : form.categoryId,
            target_post_id : form.postId,
            target_note_id : form.noteId,
        }
        data[item.entity + '_id'] = item.id;
        this.request('guide.create', {
            table: 'links',
            data: data
        }, this._createCallback.bind(this));
    },
    delete(item = null, entity = null) {
        item = item ? item : this.deleteAsk.item;
        entity = entity ? entity : this.deleteAsk.entity;
        if (entity === 'category') {
            return this.clearCategory(item);
        }
        let self = this;
        let id = item.id;
        this.request('guide.delete', {
           'table' : item.entity + 's',
           'id' : id
        }, function(res) {
            self[item.entity + 'Remove'](id);
            self.deleteAsk = null;
        });
    },
    clearCategory(item) {
        let self = this;
        item.categoryPostIds.forEach(function(id) {
            let post = self.getPost(id);
            self.delete(post);
        });
    },

    projectRemove(id) {
        let project = this.projects[id];
        console.log('Remove project:', project);
        let self = this;
        project.noteIds.forEach(function(id) {
            self.noteRemove(id);
        });
        project.postIds.forEach(function(id) {
            self.postRemove(id);
        });
        project.topicIds.forEach(function(id) {
            self.topicRemove(id);
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
    topicRemove(id) {
        let topic = this.topics[id];
        console.debug('Remove topic:', topic);
        // delete notes:
        for (const [noteId, note] of Object.entries(this.notes)) {
            if (parseInt(note.topicId) === parseInt(id)) {
                this.noteRemove(noteId);
            }
        }
        // delete topics:
        for (const [postId, post] of Object.entries(this.posts)) {
            if (parseInt(post.categoryId) === parseInt(id) ||
                parseInt(post.topicId) === parseInt(id)) {
                this.postRemove(postId);
            }
        }
        // delete links:
        for (const [linkId, link] of Object.entries(this.links)) {
            if (parseInt(link.targetCategoryId) === parseInt(id)) {
                delete this.links[linkId];
            }
        }
        // remove topic id from project:
        if (topic.projectId) {
            let project = this.getProject(topic.projectId);
            project.topicIds = this._removeFromIds(id, project.topicIds);
        }
        if (this.topicsId && parseInt(this.topicsId) === parseInt(id)) {
            this.topicsId = null;
            this.changeTab('Info');
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
    postRemove(id) {
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
            self.noteRemove(parseInt(id));
        });
        // remove post links:
        post.linkIds.forEach(function(id) {
           delete self.links[id];
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
    noteRemove(id) {
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
        let self = this;
        note.linkIds.forEach(function(id) {
            delete self.links[id];
        });
        if (this.notesId && parseInt(this.notesId) === parseInt(id)) {
            this.notesId = null;
        }
        delete this.notes[id];
    },
    linkRemove(id) {
        let link = this.links[id];
        // remove link from post:
        let post = this.getPost(link.postId);
        if (post) {
            post.linkIds = this._removeFromIds(id, post.linkIds);
        }
        // remove link from note:
        let note = this.getNote(link.noteId);
        if (note) {
            note.linkIds = this._removeFromIds(id, note.linkIds);
        }
        delete this.links[id];
    },

    askDeletion(item, entity = '') {
        this.deleteAsk = {
            item : item,
            entity : entity
        }
    },
    resetAdding() {
        let self = this;
        this._addingFields.forEach(function(field) {
            self[field] = false;
        });
        if (this.tab === 'ProjectInfo' && !this.projectsId) {
            this.tab = 'Info';
        }
        if (this.tab === 'Category' && !this.categoriesId) {
            this.tab = 'Info';
        }
        if (this.tab === 'Topic' && !this.topicsId) {
            this.tab = 'Info';
        }
    },
    resetSelect() {
        if (this.linksId) {
            this.linksId = null
        } else if (this.notesId) {
            this.notesId = null;
        } else if (this.postsId) {
            this.postsId = null;
        }
        this.draggable = false;
    },

    dragged(event) {
        let entity = event.item.getAttribute('data-entity');
        let id = event.item.getAttribute('data-id');
        let newNumber = event.newIndex + 1;
        this.updateField(entity, 'number', newNumber, id);
    },
    changeTab(tab) {
        this._setBackLink();
        this.tab = tab;
    },
    goTo(link, target) {
        this._setBackLink();
        let self = this;
        if (link.targetCategoryId) {
            this.tab = 'Category';
            this.categoriesId = link.targetCategoryId;
        }
        if (target === 'category') {
            setTimeout(function() {
                location.hash = "#" + 'category' + self.categoriesId;
            }, 200);
            return;
        }
        this.postsId = link.targetPostId;
        if (target === 'post') {
            setTimeout(function() {
                location.hash = "#" + 'post' + self.postsId;
            }, 200);
            return;
        }
        if (!link.targetCategoryId) {
            this.tab = 'Info';
        }
        this.notesId = link.targetNoteId;
        if (target === 'note') {
            setTimeout(function() {
                location.hash = "#" + 'note' + self.notesId;
            }, 200);
            return;
        }
        this.linksId = link.targetLinkId;
        setTimeout(function() {
            location.hash = "#" + 'link' + self.linksId;
        },200);
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
        let isAdding = false;
        this._addingFields.forEach(function(field) {
            if (self[field]) {
                isAdding = true;
            }
        });

        return isAdding;
    },

    _createCallback(res) {
        if (res.status === 201) {
            this._registerItem(res.data.data);
        } else {
            console.error(res);
        }
        this.resetAdding();
    },
    _registerItem(item) {
        let entity = item.entity;
        this[entity + 's'][item.id] = item;
        this[entity + 'sId'] = item.id;
        let belongsTo = [];
        switch (entity) {
            case 'project':
                this.projectsId = item.id;
                break;
            case 'topic':
                if (item.projectId) {
                    belongsTo = ['project'];
                }
                this.topicsId = item.id;
                break;
            case 'post':
                belongsTo = ['topic', 'project'];
                // add new post id to category:
                let category = this.getTopic(item.categoryId);
                category.categoryPostIds = this._addToIds(item.id, category.categoryPostIds);
                // update current category:
                this.categoriesId = item.categoryId;
                break;
            case 'note':
                belongsTo = ['topic'];
                belongsTo.push(item.projectId ? 'project' : 'post');
                break;
            case 'link':
                belongsTo.push(item.postId ? 'post' : 'note');
                break;
        }
        let self = this;
        belongsTo.forEach(function(belongsEntity) {
            self._register(item, belongsEntity);
        });
    },
    _register(item, entity) {
        let belongsTo = this.getItem(entity, item[entity + 'Id']);
        let idsField = item.entity + 'Ids';
        belongsTo[idsField] = this._addToIds(item.id, belongsTo[idsField]);
    },
    _updateNumbers(oldNumber, newNumber, list) {
        console.log('old - new: ', oldNumber, newNumber);
        let ids = [];
        toRaw(list).forEach(function(item) {
            ids.splice(item.number - 1, 0, toRaw(item.id));
        });
        console.log('list ids before:', ids);
        let id = ids.splice(oldNumber - 1, 1)[0];
        console.log('change position for', id);
        ids.splice(newNumber - 1, 0, id);
        console.log('list ids after:', ids);
        list.forEach(function(item) {
            item.number = ids.indexOf(item.id) + 1;
        });
        console.log('list items:', toRaw(list));

        return this._sortItemsByNumber(list);
    },
    _sortItemsByNumber(list) {
        list.sort(function(a, b) {
            return a.number - b.number;
        });

        return list;
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
