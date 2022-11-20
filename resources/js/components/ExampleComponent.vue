<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Adding a post title form</div>
                    <div class="card-body">
                        <form v-if="id == ''" @submit.prevent="addPost">
                            <input type="text" v-model="name">
                            <button> Save</button>
                        </form>
                        <form v-else @submit.prevent="updatePost">
                            <input type="text" v-model="name">
                            <input type="hidden" v-model="id">
                            <button> Update</button>
                        </form>
                        
                        
                        <ul>
                            <li v-for="item in posts">{{ item.name }} 
                                <button type="button" @click="edit(item)">Edit</button>
                                <button type="button" @click="deletePost(item)">Delete</button>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

    export default {
        data() {
            return {
                posts: [],
                name: '',
                id:''
            }
        },
        methods:
        {

            addPost(){
                    axios.post('api/post/store',{
                        name:this.name
                    })
                        .then(({data}) => {
                            this.posts.unshift(data.data);
                            // alert(data.msg);
                            this.name = '';
                            
                        })
            },
            updatePost(){
                    axios.post('api/post/update/'+this.id,{
                        name:this.name,
                        id:this.id,
                    })
                        .then(({data}) => {
                            console.log(data.data);
                            var index = this.posts.findIndex(x => x.id == data.data.id );
                            this.posts[index].name =  data.data.name;
                            this.id = ''
                            this.name = '';
                            // this.posts.unshift(data.data);
                            // alert(data.msg);
                            
                        })
            },


            deletePost(item){
                    axios.post('api/post/delete/'+ item.id,{
                        id:item.id,
                    })
                        .then(({data}) => {
                            console.log(data);
                            let index = this.posts.findIndex(x => x.id ==  item.id)
                            this.posts.splice(index, 1)
                            alert(data.msg);
                            
                        })
            },

            getPosts() {
            axios
                .get('api/post/index')
                .then(response => {
                    this.posts = response.data.data;
                });
            },
            edit(item){
                this.id = item.id
                this.name = item.name
            },

    
        },

        mounted() {
            this.getPosts();
        }
    }
</script>
