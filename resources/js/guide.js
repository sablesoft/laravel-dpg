import {reactive} from 'vue';

export const guide = reactive({
    projects : {},
    topics : {},
    notes : {},
    posts : {},
    topicsId : null,
    projectsId : null,
    isReady: false,
    isAddNote: false,
    isAddTopic: false,
    isAddProject: false,
    topicForm : {
        name : null,
        desc : null,
        project_id: null
    },
    init(data) {
        for (const [key, value] of Object.entries(data)) {
            this[key] = value.data ? value.data : value;
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
        let notes = [];
        let self = this;
        project.noteIds.forEach(function(id) {
           notes.push(self.notes[id]);
        });

        return notes;
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
        if (!topic) {
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
    delete(table) {
        let id = this[table + 'Id'];
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
                    self.topicsId = null;
                    break;
                default:
                    break;
            }
        });
    },
    removeTopic(id) {
        let topic = this.topics[id];
        console.log('Remove topic:', topic);
        for (const [noteId, note] of Object.entries(this.notes)) {
            if (note.topicId === id) {
                this.removeNote(noteId);
            }
        }
        for (const [postId, post] of Object.entries(this.posts)) {
            if (post.topicId === id) {
                this.removePost(postId);
            }
        }
        delete this.topics[id];
    },
    removeNote(id) {
        let note = this.notes[id];
        console.log('Remove note:', note);
        if (note.projectId) {
            let project = this.projects[note.projectId];
            let noteIds = project.noteIds;
            const index = noteIds.indexOf(parseInt(id));
            if (index > -1) {
                noteIds.splice(index, 1);
                project.noteIds = noteIds;
                console.log('Project noteIds cleared!', project);
            }
        }
        if (note.postId) {
            let post = this.posts[note.postId];
            const index = post.noteIds.indexOf(id);
            if (index > -1) {
                post.noteIds.splice(index, 1);
            }
        }
        delete this.notes[id];
    },
    removePost(id) {
        let post = this.posts[id];
        console.log('Remove post:', post);
        let project = this.projects[post.projectId];
        const index = project.postIds.indexOf(id);
        if (index > -1) {
            project.postIds.splice(index, 1);
        }
        delete this.posts[id];
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
    addProjectNote(form) {
        let self = this;
        this.createNote({
            target : 'project',
            targetId :  this.projectsId,
            topicId : form.topicId,
            content : form.content
        }, function(res) {
            if (res.status === 201) {
                console.log('addProjectNote - response', res.data);
                let note = res.data.data;
                self.notes[note.id] = note;
                let project = self.getProject();
                project.noteIds.push(parseInt(note.id));
                console.log(self.notes);
            }
            self.isAddNote = false;
        });
    },
    createTopic(config, callback) {
        let post = {
            table: 'topics',
            data: config
        };
        this.request('guide.create', post, callback);
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
                console.log('addTopic - response', res.data);
                let topic = res.data.data;
                self.topics[topic.id] = topic;
                console.log(self.topics);
            }
            self.isAddTopic = false;
        });
    },
    addProject(form) {
        let self = this;
        let post = {
            table: 'projects',
            data : form
        };
        this.request('guide.create', post, function(res) {
            if (res.status === 201) {
                let project = res.data.data;
                if (Array.isArray(self.projects.data) && !self.projects.data.length) {
                    self.projects.data = {};
                }
                self.projects.data[project.id] = project;
            }
            self.isAddProject = false;
        });
    }
});
