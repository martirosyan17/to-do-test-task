<template>
    <div class="container">
           <div class="to-do-container m-auto col-md-6">
               <div class="row">
                   <div class="form-group col-md-12">
                       <input type="text" class="form-control" placeholder="Enter a new task..." v-model="newTask" v-on:keyup.enter="addList">
                   </div>
               </div>
               <div class="row to-do-list">
                   <ul class="list-group list-group-flush">
                       <li v-for="(task,index) in taskList " class="list-item">
                           {{task.list}}
                       </li>
                   </ul>
               </div>
           </div>
    </div>
</template>

<script>
    export default {
        name: "ToDoComponent",
        data(){
            return {
                newTask:'',
                taskList:[],
            }
        },
        mounted(){
          Vue.$http.get('/get-todo').then((response)=>{
              for(let i = 0;i<response.data.length;++i) {
                  this.taskList.push({
                        list:response.data[i]['list'],
                    });
                }
          })
        },
        methods:{
            addList(){
                if(this.newTask!=''){
                    let task = this.newTask;
                    Vue.$http.post('/add-todo',{task: this.newTask}).then((response)=>{
                      if(response.status == 200) {
                          this.taskList.unshift({
                              list:task,
                          });
                      }
                    })
                }
                 this.newTask=''
            }
        }
    }
</script>

<style scoped>
    .to-do-container {
        background: #f3f3f3;
        margin-top: 50px !important;
        padding: 35px;
    }
    .list-group {
        padding-left: 33px;
    }
    .list-item {
       padding-bottom:5px;
    }

    .form-control:focus {
        border-color: unset !important;
        box-shadow: unset !important;
    }
</style>