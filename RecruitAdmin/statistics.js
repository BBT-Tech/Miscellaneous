new Vue({
    el: '#app',

    data: {
        collapsed: false,
        loading: false,
        header: [
            { text: '名称', value: 'name' },
            { text: '报名总人数', value: 'all' },
            { text: '男生', value: 'boy' },
            { text: '女生', value: 'girl' },
            { text: '第一志愿总数', value: 'fcall' },
            { text: '第一志愿男生', value: 'fcboy' },
            { text: '第一志愿女生', value: 'fcgirl' },
            { text: '第二志愿总数', value: 'scall' },
            { text: '第二志愿男生', value: 'scboy' },
            { text: '第二志愿女生', value: 'scgirl' }
        ],
        data: []
    },

    created: function () {
        this.toggleDepList();
    },

    methods: {
        toggleDepList: function () {
            this.loading = true;

            url = 'mock-statistics.json';
            this.collapsed = !this.collapsed;
            if (this.collapsed) url += '?c';

            fetch(url, { method: 'GET' })
            .then(response => response.json())
            .then((res) => this.data = res)

            this.loading = false;
        },

        jump: function () {
            location.href = 'data.html';
        }
    }
})
