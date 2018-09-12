new Vue({
    el: '#app',
    data: {
        search: '', title: '', detail: '',
        department: '', password: '',
        logedin: false, loading: false, dialog: false,

        header: [
            { text: '姓名', value: 'name' },
            { text: '性别', value: 'sex' },
            { text: '学院', value: 'college' },
            { text: '年级', value: 'grade' },
            { text: '宿舍', value: 'dorm' },
            { text: '手机', value: 'phone' },
            { text: '第一志愿', value: 'first' },
            { text: '第二志愿', value: 'second' },
            { text: '服从调剂', value: 'adjust' },
            { text: '个人简介', value: 'introduction' },
            { text: '提交时间', value: 'create_time' }
        ],

        deps: [
            '技术部', '视频部', '外联部', '节目部', '编辑部',
            '人力资源部', '策划推广部', '综合管理部',
            '视觉设计部', '综合新闻部', '产品运营部',
            'Deep♂Dark♂Fantasy'
        ],

        data: []
    },

    created: function () {
        fetch('mock-status.json', { method: 'GET' })
        .then(response => response.json())
        .then((res) => {
            if (res.ojbk) {
                this.department = res.name;
                this.renewList();
            }
        })
    },

    methods: {
        renewList: function () {
            this.loading = true;

            fetch('mock-data.json', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: this.password == '' ? '' :
                    'name=' + this.department + '&password=' + this.password
            })
            .then(response => response.json())
            .then((res) => {
                if (res.code == 0)
                    this.data = res.data;
                else
                    this.showModel(res.message, true);
            })

            this.loading = false;
        },

        showModel: function (item, err =false) {
            if (err) {
                this.title = item;
                this.detail = '请根据上述错误提示重新修改提交或联系管理员';
            } else {
                this.title = item.name + '的个人简介';
                this.detail = item.introduction;
            }
            this.dialog = true;
        },

        jump: function () {
            location.href = 'statistics.html';
        }
    }
})
