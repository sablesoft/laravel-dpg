import {reactive} from 'vue';

export const guide = reactive({
    project : null,
    projects : null,
    topics : null,
    topic : null,
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
            this[key] = value;
        }
        this.isReady = true;
        console.log(this);
    },
    request(routeName, post, callback) {
        axios.post(route(routeName), post)
            .then(response => callback(response))
            .catch(err => {
                console.error(err);
            });
    },
    updateProject(field, value) {
        let self = this;
        this.request('guide.update', {
            table: 'projects',
            id: this.project.data.id,
            field: field,
            value: value
        }, function(res) {
            self.project.data[field] = value;
        });
    },
    updateNote(id, value) {
        let self = this;
        this.request('guide.update', {
            table: 'notes',
            id: id,
            field: 'content',
            value: value
        }, function(res) {
            let note = self.project.data.notes[id];
            note.content = value;
        });
    },
    updateTopic(id, value, field) {
        let self = this;
        this.request('guide.update', {
            table: 'topics',
            id: id,
            field: field,
            value: value
        }, function(res) {
            let topic;
            if (self.project) {
                topic = self.project.data.topics[id];
            } else {
                topic = self.topics.data[id];
            }
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
            targetId :  this.project.data.id,
            topicId : form.topicId,
            content : form.content
        }, function(res) {
            if (res.status === 201) {
                let note = res.data.data;
                if (Array.isArray(self.project.data.notes) && !self.project.data.notes.length) {
                    self.project.data.notes = {};
                }
                self.project.data.notes[note.id] = note;
                console.log(self.project.data);
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
                project_id : this.project ? this.project.data.id : null
            },
            function(res) {
            if (res.status === 201) {
                let topic = res.data.data;
                if (!self.project) {
                    if (Array.isArray(self.topics) && !self.topics.data.length) {
                        self.topics.data = {};
                    }
                    self.topics.data[topic.id] = topic;
                    self.isAddTopic = false;
                    return;
                }
                if (Array.isArray(self.project.data.topics) && !self.project.data.topics.length) {
                    self.project.data.topics = {};
                }
                self.project.data.topics[topic.id] = topic;
                console.log(self.project.data);
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
