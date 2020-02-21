<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  
//   props: {id:{type:Number}, user:{type:Number},csrf:{
//                 type: String
//             }},
  data() {
    return {
      form: {
        name: "12",
        region: "",
        date1: "",
        date2: "",
        delivery: false,
        type: [],
        resource: "",
        desc: ""
      },
      form2: {},
      fileList: [
        
      ],
      DataResult: {
        created_at: ""
      },
      Responsables: [],
      Message: [],
      textarea: "",
      anotacion: "",
      message: "",
      id_user: "",
      id_evento: "",
      id_enviado:1
    };
  },
  mounted() {
    // // invocar los métodos
    // this.llenado();
    // this.getResponsables();
    // // console.log(this.id);
    // this.getChat();
    // this.getFile();
    // setInterval(() => {
    //   this.getChat();
    // }, 1000);
  },
  methods: {
      handleChange(file, fileList) {
        this.fileList = fileList.slice(-3);
      },
    llenado: function() {
      
      axios
        .get("/searchEvento/" + this.id)
        .then(response => {
          // handle success
          this.DataResult = response.data;
          //console.log(response.data);
          //this.total= response.data;
          //console.log(this.DataResult);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .finally(function() {
          // always executed
        });
    },
    getResponsables: function() {
      axios
        .get("/getDataRes")
        .then(response => {
          this.Responsables = response.data;
          //console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getChat: function() {
      axios
        .get("/getChat/" + this.id)
        .then(response => {
          this.Message = response.data;
          //console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getFile: function(){
      axios.get('/fileList/'+ this.id)
      .then(response =>{
      //console.log("dentro");
          this.fileList = response.data;
          
      }).catch(function(error) {
          console.log(error);
        });
    }
    ,
    onSubmit() {
      let anotacion;
      anotacion = this.textarea;
      //anotacion = this.textarea;
      var url = "/addMessages";
      axios
        .post(url, {
          message: this.textarea,
          id_user: this.user,
          id_evento: this.id
        })
        .then(response => {
          // $('#table-vue-asede').DataTable().ajax.reload();
          //$("#snoAlertBox").fadeIn();
          //closeSnoAlertBox("#snoAlertBox");
          //this.$message.warning(`El límite es 3, haz seleccionado  archivos esta vez, añade hasta `);
          this.textarea = "";
          console.log("guardado");
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    handleRemove(file, fileList) {
      let vm = this
        axios.delete('/upload/' + file.uid)
            .then(function () {
                let index = _.findIndex(vm.fileList, ['uid', file.uid])
                vm.$delete(vm.fileList, index)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    handlePreview(file) {
      console.log(file);
    },
    handleExceed(files, fileList) {
      this.$message.warning(
        `El límite es 3, haz seleccionado ${
          files.length
        } archivos esta vez, añade hasta ${files.length + fileList.length}`
      );
    },
    cargaSuccess(response, file, fileList) {
      let id_fila = ''
      var vm = this
        _.map(response, function (data) {
            file['uid'] = data
            
        })
        vm.fileList = fileList;
      
      var url = "/Uploadfile";
      axios
        .post(url, {
          id_evento: this.id,
          id_file: file.uid
        })
        .then(response => {
          this.$message.success(`Documento Cargado`);
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    submitForm2 () { 
      this.loading = true 
      if(this.$refs.upload._data.uploadFiles.length !== 0){ 
        return this.$refs.upload.submit() 
      } 
        return axios.post('/api/v1/news/store',this.form)
          .then((response) =>{ 
              this.$emit('news-data',response.data.data) 
              this.loading = false 
              this.closeNewsForm() 
              this.resetForm() 
          })
          .catch((error) =>{ 
              this.form.errors = error.response.data.errors 
              this.loading = false 
              console.log(error.response.data) 
          }) 
    }
  }
};
</script>