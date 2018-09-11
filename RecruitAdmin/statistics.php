<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.bootcss.com/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/vuetify/1.1.0-beta.0/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>

<body>
    <div id="app">
        <v-app>
            <center>
                <div class="headline my-3">BBT 18 秋招 · 实时报名情况统计</div>
            </center>

            <v-data-table
            :headers="header"
            :items="data"
            :loading="loading"
            hide-actions
            class="elevation-1">
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="props">
                    <td>{{ props.item.name }}</td>
                    <td>{{ props.item.all }}</td>
                    <td>{{ props.item.boy }}</td>
                    <td>{{ props.item.girl }}</td>
                    <td>{{ props.item.fcall }}</td>
                    <td>{{ props.item.fcboy }}</td>
                    <td>{{ props.item.fcgirl }}</td>
                    <td>{{ props.item.scall }}</td>
                    <td>{{ props.item.scboy }}</td>
                    <td>{{ props.item.scgirl }}</td>
                </template>
            </v-data-table>

            <v-btn medium color="blue" dark @click="toggleDepList">
                <span v-if="collapsed">收起</span>
                <span v-else>展开</span>
                各部门分组
            </v-btn>
        </v-app>
    </div>
 
    <script src="https://cdn.bootcss.com/vue/2.5.16/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/vuetify/1.1.0-beta.0/vuetify.min.js"></script>

    <script>
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
            methods: {
                toggleDepList: function () {
                    this.collapsed = !this.collapsed;
                    this.loading = true;
                    if (this.collapsed) {
                        this.data = [
                            {
                                name: '技术部 - 代码组',
                                all: 1171,
                                boy: 1983,
                                girl: 4704,
                                fcall: 1678,
                                fcboy: 4700,
                                fcgirl: 189,
                                scall: 3415,
                                scboy: 2164,
                                scgirl: 922
                            },
                            {
                                name: '技术部 - 设计组',
                                all: 2643,
                                boy: 1687,
                                girl: 490,
                                fcall: 3424,
                                fcboy: 1470,
                                fcgirl: 4203,
                                scall: 968,
                                scboy: 1144,
                                scgirl: 2148
                            }
                        ];
                    } else {
                        this.data = [
                            {
                                name: '技术部',
                                all: 2825,
                                boy: 5103,
                                girl: 888,
                                fcall: 1263,
                                fcboy: 4660,
                                fcgirl: 3401,
                                scall: 2094,
                                scboy: 4065,
                                scgirl: 1616
                            }
                        ];
                    }
                    this.loading = false;
                }
            }
        })
    </script>
</body>
</html>
