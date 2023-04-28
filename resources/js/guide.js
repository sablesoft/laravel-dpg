import {reactive, toRaw} from 'vue';
import { isEmpty, isNumber } from "lodash/lang";

export const guide = reactive({
    tab: 'Info',
    projects : {},
    modules : {},
    topics : {},
    posts : {},
    notes : {},
    links : {},
    tags : {},
    buffers: {},
    projectsId : null,
    modulesId : null,
    buffersId : null,
    categoriesId : null,
    topicsId : null,
    postsId : null,
    notesId : null,
    linksId : null,
    tagsId : null,
    projectAdding: false,
    moduleAdding: false,
    topicAdding: false,
    postAdding: false,
    noteAdding: false,
    linkAdding: false,
    tagAdding: false,
    backLink: null,
    deleteAsk: null,
    isReady: false,
    draggable: false,
    _itemsIdFields : ['categoriesId', 'topicsId', 'postsId', 'notesId', 'linksId'],
    _addingFields : [
        'projectAdding', 'moduleAdding', 'topicAdding',
        'postAdding', 'noteAdding', 'linkAdding', 'tagAdding'
    ],

    // ========== METHODS ===========

    init(config) {
        for (const [key, value] of Object.entries(config)) {
            let data = value.data ? value.data : value;
            if (isNumber(data) || !isEmpty(data)) {
                this[key] = data;
            }
        }
        this.isReady = true;
        console.log('GUIDE:', toRaw(this));
    },

    // item getters:
    getItem(entity, id = null) {
        id = id ? id : this[entity + 'sId'];
        return id ? this[entity + 's'][id] : null;
    },
    getProject(id = null) {
        return this.getItem('project', id);
    },
    getModule(id = null) {
        return this.getItem('module', id);
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
    getTag(id = null) {
        return this.getItem('tag', id);
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
    getModuleTopic(id = null) {
        return this.getRelation('module', 'topic', id);
    },
    getModuleType(id = null) {
        let module = this.getItem('module', id);
        if (!module) {
            return null;
        }

        return this.getTopic(module.typeId);
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
                let relation = self[relationEntity + 's'][id];
                if (relation) {
                    relations.push(relation);
                }
            });
        } else {
            relations = {};
            item[relationEntity + 'Ids'].forEach(function(id) {
                let relation = self[relationEntity + 's'][id];
                if (relation) {
                    relations[id] = relation;
                }
            });
        }

        return relations;
    },
    getProjectNotes(id = null) {
        let notes = this.getRelations('project', 'note', id, true);

        return this._sortItemsByNumber(notes);
    },
    getModuleNotes(id = null) {
        let notes = this.getRelations('module', 'note', id, true);

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
    getProjectModules(id = null) {
        let modules = this.getRelations('project', 'module', id, true);
        modules.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return modules;
    },
    getTopics() {
        let entity = this.modulesId ? 'module' : 'project';
        let topics = this.getRelations(entity, 'topic', null, true);
        topics.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return topics;
    },
    getProjectPosts(id = null) {
        return this.getRelations('project', 'post', id);
    },
    getModulePosts(id = null) {
        return this.getRelations('module', 'post', id);
    },
    getPostNotes(id = null) {
        let notes = this.getRelations('post', 'note', id, true);

        return this._sortItemsByNumber(notes);
    },
    getPostLinks(id = null) {
        let links = this.getRelations('post', 'link', id, true);

        return this._sortItemsByNumber(links);
    },
    getPostTags(id = null) {
        return guide.getRelations('post', 'tag', id, true)
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

    getCategories(id = null) {
        id = id ? id : (this.linkAdding ? null : this.modulesId);
        let posts = id ? this.getModulePosts(id) : this.getProjectPosts();
        if (isEmpty(posts)) {
            return {};
        }
        let ids = {};
        let categories = [];
        for (const [postId, post] of Object.entries(posts)) {
            if (post.moduleId && (parseInt(post.moduleId) !== parseInt(id))) {
                continue;
            }
            if (!ids[post.categoryId]) {
                categories.push(this.getTopic(post.categoryId));
                ids[post.categoryId] = true;
            }
        }
        categories.sort((a,b) => (a.name > b.name) ? 1 : ((b.name > a.name) ? -1 : 0));

        return categories;
    },
    // todo - add tags to modules:
    getTags(id = null) {
        let self = this;
        let tags = this.getRelations('project', 'tag', id, true);
        let ids = {};
        let topics = [];
        tags.forEach(function(tag) {
            if (!ids[tag.topicId]) {
                topics.push(self.getRelation('tag', 'topic', tag.id));
                ids[tag.topicId] = true;
            }
        });

        return topics;
    },
    getCategoryPosts(id = null, moduleId = null) {
        id = id ? id : this.categoriesId;
        moduleId = moduleId ? moduleId : (this.linkAdding ? null : this.modulesId);
        let topic = this.getTopic(id);
        if (!topic) {
            return [];
        }
        let self = this;
        let posts = [];
        topic.categoryPostIds.forEach(function(id) {
            let post = self.getPost(id);
            // noinspection EqualityComparisonWithCoercionJS
            if (post && (post.moduleId == moduleId)) {
                posts.push(post);
            }
        });

        return this._sortItemsByNumber(posts);
    },
    getTagPosts(id = null) {
        id = id ? id : this.topicsId;
        let topic = this.getTopic(id);
        if (!topic) {
            return [];
        }
        let self = this;
        let posts = [];
        topic.tagIds.forEach(function(id) {
            let post = self.getRelation('tag', 'post', id);
            if (post) {
                posts.push(post);
            }
        });

        return posts;
    },
    getGeneralTopics() {
        let topics = [];
        for (const [id, topic] of Object.entries(this.topics)) {
            if (!topic.projectId && !topic.moduleId) {
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
    createTag(form, item) {
        let data = {
            topic_id : form.topicId,
            post_id : item.id,
            project_id : item.projectId
        }
        this.request('guide.create', {
            table: 'tags',
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
                project_id: this.projectsId,
                module_id: this.modulesId
            }
        }, this._createCallback.bind(this));
    },
    createTopic(form) {
        this.request('guide.create', {
                table: 'topics',
                data : {
                    name : form.name,
                    text : form.text,
                    project_id : form.isGlobal ? null : (this.modulesId ? null : this.projectsId),
                    module_id : form.isGlobal ? null : this.modulesId
                }
            }, this._createCallback.bind(this));
    },
    createProject(form) {
        this.request('guide.create', {
            table: 'projects',
            data : {
                name: form['name'],
                code: form['code'],
                text: form['text']
            }
        }, this._createCallback.bind(this));
    },
    createModule(form) {
        this.request('guide.create', {
            table: 'modules',
            data : {
                type_id: form['typeId'],
                topic_id: form['topicId'],
                project_id: this.projectsId
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
    copy(item, entity) {
        let text = '';
        switch (entity) {
            case 'note':
                text = this._noteToText(item.id);
                break;
            case 'post':
                text = this._postToText(item.id, false);
                break;
            case 'category':
                text = this._categoryToText(item.id, false);
                break;
            case 'buffer':
                text = this.getItem('buffer').text;
                break;
            default:
                throw new Error('Unknown entity for buffering: ' + entity);
        }
        navigator.clipboard.writeText(text);
    },
    addToBuffer(item, entity) {
        let buffer = this.getItem('buffer');
        let text = buffer.text ? buffer.text + '\r\n' : '';
        switch (entity) {
            case 'note':
                text = text + this._noteToText(item.id);
                break;
            case 'post':
                text = text + this._postToText(item.id);
                break;
            case 'category':
                text = text + this._categoryToText(item.id);
                break;
            default:
                throw new Error('Unknown entity for buffering: ' + entity);
        }
        this.updateField('buffer', 'text', text);
        this.changeTab('Buffer');
    },
    downloadBuffer(id = null) {
        let buffer = this.getItem('buffer', id);
        if (!buffer || !buffer.text) {
            return;
        }
        let now = new Date();
        let filename = now.getFullYear() +'-'+ (now.getMonth() + 1) +'-'+
            now.getDate() +'-'+ now.getHours() +'-'+ now.getMinutes() + '.md';
        let element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(buffer.text));
        element.setAttribute('download', filename);
        element.style.display = 'none';
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    },
    delete(item = null, entity = null) {
        item = item ? item : this.deleteAsk.item;
        entity = entity ? entity : this.deleteAsk.entity;
        if (entity === 'category') {
            return this.clearCategory(item);
        }
        if (entity === 'buffer') {
            return this.clearBuffer(item);
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
    clearBuffer(item) {
        let self = this;
        this.request('guide.update', {
            table: 'buffers',
            id: item.id,
            field: 'text',
            value: null
        }, function(res) {
            if (res.data.success) {
                item['text'] = null;
                item['updatedAt'] = res.data.updatedAt;
            } else {
                console.error('Update field problem', res);
            }
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

    moduleRemove(id) {
        let module = this.modules[id];
        let self = this;
        module.noteIds.forEach(function(id) {
            self.noteRemove(id);
        });
        module.postIds.forEach(function(id) {
            self.postRemove(id);
        });
        module.topicIds.forEach(function(id) {
            self.topicRemove(id);
        });
        if (this.modulesId && parseInt(this.modulesId) === parseInt(id)) {
            this.modulesId = null;
            this.tab = 'Info';
        }
        // pause for all staff deleting:
        setTimeout(function() {
            delete self.modules[id];
        }, 2000);
    },
    projectRemove(id) {
        let project = this.projects[id];
        let self = this;
        project.moduleIds.forEach(function(id) {
            self.moduleRemove(id);
        });
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
        // delete modules:
        for (const [moduleId, module] of Object.entries(this.modules)) {
            if (parseInt(module.topicId) === parseInt(id)) {
                this.moduleRemove(moduleId);
            }
        }
        // remove topic id from project:
        if (topic.projectId) {
            let project = this.getProject(topic.projectId);
            project.topicIds = this._removeFromIds(id, project.topicIds);
        }
        // remove topic id from module:
        if (topic.moduleId) {
            let module = this.getModule(topic.moduleId);
            module.topicIds = this._removeFromIds(id, module.topicIds);
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
    tagRemove(id) {
        let tag = this.tags[id];
        // remove tag from post:
        let post = this.getPost(tag.postId);
        if (post) {
            post.tagIds = this._removeFromIds(id, post.tagIds);
        }
        // remove tag from project:
        let project = this.getProject(tag.projectId);
        if (project) {
            project.tagIds = this._removeFromIds(id, project.tagIds);
        }
        // remove tag from topic:
        let topic = this.getTopic(tag.topicId);
        if (topic) {
            topic.tagIds = this._removeFromIds(id, topic.tagIds);
        }
        delete this.tags[id];
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
        let module = this.getRelation('post', 'module', link.targetPostId);
        this.modulesId = module ? module.id : null;
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

    _categoryToText(id = null, withPosts = true) {
        let category = this.getItem('topic', id ? id : this.categoriesId);
        if (!category) {
            return '';
        }
        let self = this;
        let title = '# ' + category.name + '\r\n';
        let text = title + (category.text ? category.text + '\r\n' : '');
        if (withPosts) {
            let posts = this.getCategoryPosts(category.id);
            posts.forEach(function(post) {
                text = text + '\r\n' + self._postToText(post.id);
            });
        }

        return text;
    },
    _postToText(id = null, withNotes = true) {
        let post = this.getItem('post', id);
        if (!post) {
            return '';
        }
        let text = '';
        let title = '## ';
        title = title + this.getTopic(post.categoryId).name + ' - ';
        title = title + this.getTopic(post.topicId).name + '\r\n';
        text = text + title + post.text + '\r\n';
        let self = this;
        let links = this.getRelations('post', 'link', id, true);
        links = this._sortItemsByNumber(links);
        links.forEach(function(link) {
            text = text + self._linkToText(link.id);
        });
        if (withNotes) {
            let notes = this.getRelations('post', 'note', id, true);
            notes =  this._sortItemsByNumber(notes);
            notes.forEach(function(note) {
                text = text + '\r\n' + self._noteToText(note.id);
            });
        }

        return text;
    },
    _noteToText(id = null) {
        let note = this.getItem('note', id);
        if (!note) {
            return '';
        }
        let text = '';
        let title = '### ';
        if (note.postId) {
            let post = this.getItem('post', note.postId);
            title = title + this.getTopic(post.categoryId).name + ' - ';
            title = title + this.getTopic(post.topicId).name + ' - ';
        }
        text = text + title + this.getRelation('note', 'topic', note.id).name + '\r\n';
        text = text + note.text + '\r\n';
        let self = this;
        let links = this.getRelations('note', 'link', id, true);
        links = this._sortItemsByNumber(links);
        links.forEach(function(link) {
            text = text + self._linkToText(link.id);
        });

        return text;
    },
    _linkToText(id = null) {
        let link = this.getItem('link', id);
        if (!link) {
            return '';
        }
        // let text = '*[(' + link.number + ')]: ';
        let text = link.number + '. ';
        text = text + this.getTopic(link.targetCategoryId).name + ' - ';
        text = text + this.getRelation('post', 'topic', link.targetPostId).name;
        if (link.targetNoteId) {
            text = text + ' - ' + this.getRelation('note', 'topic', link.targetNoteId).name;
        }
        text = text + '\r\n';

        return text;
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
            case 'module':
                belongsTo = ['project', 'topic'];
                this.modulesId = item.id;
                break;
            case 'topic':
                if (item.projectId) {
                    belongsTo = ['project'];
                }
                if (item.moduleId) {
                    belongsTo = ['module'];
                }
                this.topicsId = item.id;
                break;
            case 'post':
                belongsTo = ['topic', 'project', 'module'];
                // add new post id to category:
                let category = this.getTopic(item.categoryId);
                category.categoryPostIds = this._addToIds(item.id, category.categoryPostIds);
                // update current category:
                this.categoriesId = item.categoryId;
                break;
            case 'note':
                belongsTo = ['topic'];
                if (item.postId) {
                    belongsTo.push('post');
                } else {
                    belongsTo.push(item.projectId ? 'project' : 'module');
                }
                break;
            case 'link':
                belongsTo.push(item.postId ? 'post' : 'note');
                break;
            case 'tag':
                belongsTo = ['post', 'project', 'topic'];
        }
        let self = this;
        belongsTo.forEach(function(belongsEntity) {
            self._register(item, belongsEntity);
        });
    },
    _register(item, entity) {
        let belongsTo = this.getItem(entity, item[entity + 'Id']);
        if (!belongsTo) {
            return;
        }
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
    _sortItemsByNumber(list, field = 'number') {
        list.sort(function(a, b) {
            return a[field] - b[field];
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
        this.resetAdding();
        this._resetItemIds();
    },
    _resetItemIds() {
        let self = this;
        this._itemsIdFields.forEach(function(field) {
            self[field] = null;
        });
    }
});
