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
                <div class="headline my-3">BBT 18 秋招 · 报名数据</div>
            </center>

            <v-card>
                <v-card-title>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="搜索内容"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>

                <v-data-table
                :headers="header"
                :items="data"
                :search="search"
                :loading="loading"
                hide-actions
                class="elevation-1">
                    <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.name }}</td>
                        <td>{{ props.item.sex }}</td>
                        <td>{{ props.item.college }}</td>
                        <td>{{ props.item.grade }}</td>
                        <td>{{ props.item.dorm }}</td>
                        <td>{{ props.item.phone }}</td>
                        <td>{{ props.item.first }}</td>
                        <td>{{ props.item.second }}</td>
                        <td>{{ props.item.adjust }}</td>
                        <td @click="showIntro(props.item)">
                            <a href="#">点击查看></a>
                        </td>
                        <td>{{ props.item.create_time }}</td>
                    </template>

                    <template slot="no-data">
                        <v-alert :value="true" color="error" icon="warning">
                            唔= = 暂无报名数据
                        </v-alert>
                    </template>

                    <v-alert slot="no-results" :value="true" color="error" icon="warning">
                        未找到 "{{ search }}" 对应的匹配项
                    </v-alert>
                </v-data-table>
            </v-card>

            <v-btn medium color="blue" dark @click="renewList">刷新</v-btn>

            <v-layout row wrap ma-3>
                <v-flex sm5 xs5>
                    <v-select
                    v-model="department"
                    :items="deps"
                    label="选择部门"
                    name="department"
                    ></v-select>
                </v-flex>

                <v-spacer></v-spacer>
                <v-flex sm5 xs5>
                    <v-text-field
                    v-model="password"
                    :type="'password'"
                    name="password"
                    label="密码"
                    required
                    ></v-text-field>
                </v-flex>
            </v-layout>

            <template>
                <v-layout row justify-center>
                    <v-dialog v-model="dialog">
                        <v-card>
                            <v-card-title class="headline">{{ name }}的个人简介</v-card-title>
                            <v-card-text>{{ introduction }}</v-card-text>
                        </v-card>
                    </v-dialog>
                </v-layout>
            </template>
        </v-app>
    </div>

    <script src="https://cdn.bootcss.com/vue/2.5.16/vue.min.js"></script>
    <script src="https://cdn.bootcss.com/vuetify/1.1.0-beta.0/vuetify.min.js"></script>

    <script>
        new Vue({
            el: '#app',
            data: {
                search: '', name: '', introduction: '',
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
                data: [],
                deps: [
                    '技术部',
                    '视频部',
                    '外联部',
                    '节目部',
                    '编辑部',
                    '人力资源部',
                    '策划推广部',
                    '综合管理部',
                    '视觉设计部',
                    '综合新闻部',
                    '产品运营部',
                    'Deep♂Dark♂Fantasy'
                ]
            },

            created: function () {
                this.renewList();
            },

            methods: {
                renewList: function () {
                    this.loading = true;

                    fetch('mock.json', {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: 'name=' + this.department + '&password=' + this.password
                    })
                    .then(response => response.json())
                    .then((data) => this.handleData(data));

                    this.loading = false;
                },

                showIntro: function (item) {
                    this.name = item.name;
                    this.introduction = item.introduction;
                    this.dialog = true;
                },

                handleData: function (data) {
                    if (data.code == 0) {
                        this.data = data;
                    } else {
                        alert('请选择');
                    }
                }
            }
        })
    </script>
</body>
</html>
