import {reactive} from 'vue';
import {isEmpty, isNumber} from "lodash/lang";

export const guide = reactive({
    projects : {},
    topics : {},
    notes : {},
    posts : {},
    links : {},
    notesId : null,
    postsId : null,
    topicsId : null,
    projectsId : null,
    categoriesId : null,
    isReady: false,
    isAddNote: false,
    isAddTopic: false,
    isAddProject: false,
    isAddPost: false,
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
    delete(table, id = null) {
        id = id ? id : this[table + 'Id'];
        if (!id) {
            return;
        }
        let entity = this[table][id];
        if (!entity) {
            throw new Error('Entity not found: ' + table + ' - ' +  id);
        }
        let self = this;
        this.request('guide.delete', {
           'table' : table,
           'id' : id
        }, function(res) {
            switch (table) {
                case 'topics':
                    self.removeTopic(id);
                    break;
                case 'projects':
                    self.removeProject(id);
                    break;
                case 'notes':
                    self.removeNote(id);
                    break;
                case 'posts':
                    self.removePost(id);
                    break;
                default:
                    break;
            }
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
        }
        let self = this;
        // pause for all staff deleting:
        setTimeout(function() {
            delete self.topics[id];
        }, 1000);
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
    updateProject(field, value) {
        let project = this.getProject();
        this.request('guide.update', {
            table: 'projects',
            id: project.id,
            field: field,
            value: value
        }, function(res) {
            project[field] = value;
        });
    },
    updateNote(id, value) {
        let note = this.notes[id];
        if (!note) {
            throw new Error('Note not found: ' + id);
        }
        this.request('guide.update', {
            table: 'notes',
            id: note.id,
            field: 'content',
            value: value
        }, function(res) {
            note.content = value;
        });
    },
    updateTopic(value, field, id = null) {
        id = id ? id : this.topicsId;
        if (!id) {
            throw new Error('No topic id for updating!');
        }
        let topic = this.topics[id];
        if (!topic) {
            throw new Error('Topic not found for updating: ' + id);
        }
        this.request('guide.update', {
            table: 'topics',
            id: id,
            field: field,
            value: value
        }, function(res) {
            topic[field] = value;
        });
    },
    createNote(config, callback) {
        let post = {
            table: 'notes',
            data: {
                topic_id: config['topicId'],
                content: config['content']
            }
        };
        post['data'][config['target'] + '_id'] = config['targetId'];
        this.request('guide.create', post, callback);
    },
    createPost(config, callback) {
        let post = {
            table: 'posts',
            data: {
                topic_id: config['topicId'],
                category_id: config['categoryId']
            }
        };
        post['data'][config['target'] + '_id'] = config['targetId'];
        this.request('guide.create', post, callback);
    },
    createTopic(config, callback) {
        let post = {
            table: 'topics',
            data: config
        };
        this.request('guide.create', post, callback);
    },
    addNote(form, target = 'project') {
        let self = this;
        let targetId = this[target + 'sId']
        this.createNote({
            target : target,
            targetId : targetId,
            topicId : form.topicId,
            content : form.content
        }, function(res) {
            if (res.status === 201) {
                let note = res.data.data;
                self.notes[note.id] = note;
                switch (target) {
                    case 'project':
                        let project = self.getProject(targetId);
                        project.noteIds = self._addToIds(note.id, project.noteIds);
                        break;
                    case 'post':
                        let post = self.getPost(targetId);
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
    addProjectPost(form) {
        let self = this;
        this.createPost({
            target : 'project',
            targetId :  this.projectsId,
            categoryId : form.categoryId,
            topicId : form.topicId
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
    addTopic(form) {
        let self = this;
        this.createTopic({
                name : form.name,
                desc : form.desc,
                project_id : this.projectsId
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
    addProject(form) {
        let self = this;
        let post = {
            table: 'projects',
            data : {
                name: form['name'],
                code: form['code']
            }
        };
        this.request('guide.create', post, function(res) {
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
    resetAdding() {
        let self = this;
        ['Note', 'Project', 'Topic', 'Post'].forEach(function(field) {
            field = 'isAdd' + field;
            self[field] = false;
        })
    },
    resetSelect() {
        let self = this;
        ['notesId', 'postsId'].forEach(function(field) {
            self[field] = null;
        })
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
    }
});
