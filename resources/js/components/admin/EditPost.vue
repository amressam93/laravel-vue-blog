<template>
    <!-- Edit Modal HTML -->
    <div id="editPostModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data" novalidate >
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Post</h4>
                        <button type="button" class="close" id="updatePostCloseButtonModal" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" required v-model="PostToEdit.title">
                        </div>
                        <div class="form-group">
                            <label>body</label>
                            <textarea name=""  cols="30" class="form-control" v-model="PostToEdit.body"
                                      rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label>category</label>
                            <select name="" class="form-control"  v-if="PostToEdit.category"  v-model="PostToEdit.category.id">
                                <option value="0" disabled selected>choose category</option>

                                <option :value="category.id" v-for="category in categories" :key="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <img :src="'img/'+PostToEdit.image" style="height:60px;width:60px;border:1px solid #999" alt="">
                            <input type="file" class="form-control" required @change="onImageChange"    >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" @click.prevent="updatePost"
                               value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {


    data(){
        return {
            categories: [],

        }
    },
    created() {
        this.getCategories();
    },
    methods: {

        getCategories(){
            axios.get('/api/admin/categories')
                .then(res => {
                    console.log(res.data);
                    this.categories = res.data;
                })

                .then(err => console.log(err))
        },

        onImageChange(e){
            console.log(e.target.files[0]);
            this.PostToEdit.image = e.target.files[0];
        },

        updatePost(){
            let config ={
                headers: {"content-type" : "multipart/form-data"}
            }

            let formData = new FormData();
            formData.append('id',this.PostToEdit.id)
            formData.append('title',this.PostToEdit.title)
            formData.append('body',this.PostToEdit.body)
            formData.append('image',this.PostToEdit.image)
            formData.append('category',this.PostToEdit.category.id)
            axios.post('/api/admin/updatePost',formData,config)
                .then(res => {
                    console.log(res);
                    // reset inputs
                    // this.title = '';
                    // this.body = '';
                    // this.category = '';
                    // this.image = '';
                    // this.$refs.fileupload.value = null;
                    this.PostToEdit.image = res.data.image;
                    document.getElementById('updatePostCloseButtonModal').click();    // close bootstrap modal after edit post
                })
                .catch(err => console.log(err))

        },

    },
    computed: {
        PostToEdit(){
            return this.$store.getters.PostToEdit;
        },
    }

}
</script>

<style scoped>

</style>
