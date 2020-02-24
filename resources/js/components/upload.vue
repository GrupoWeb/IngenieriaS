<template>
  <div class="container">
     <el-row :gutter="30">
      <el-col  >
            <!-- <div class="card  mb-3 mt-4"  >
                <div class="card-header text-white bg-info">Directorio Activo</div>
                    <div class="card-body">
                        <h5 class="card-title">Subir archivos al Directorio</h5>
                        <el-upload
                          class="upload-demo"
                          drag
                          action="https://jsonplaceholder.typicode.com/posts/"
                          :on-preview="handlePreview"
                          :on-remove="handleRemove"
                          :file-list="fileList"
                          multiple>
                          <i class="el-icon-upload"></i>
                          <div class="el-upload__text">Suelta tu archivo aquí o <em>haz clic para cargar</em></div>
                          <div slot="tip" class="el-upload__tip">Solo archivos jpg/png con un tamaño menor de 500kb</div>
                        </el-upload>
                    </div>
                </div>  -->
            <!-- <el-upload
            class="upload-demo"
            action="https://jsonplaceholder.typicode.com/posts/"
            :on-change="handleChange"
            :file-list="fileList">
            <el-button size="small" type="primary">Clic para subir archivo</el-button>
            <div slot="tip" class="el-upload__tip">Solo archivos jpg/png con un tamaño menor de 500kb</div>
            </el-upload> -->
        
        <el-card :body-style="{ margin:'10px'}">
          <div slot="header" class="clearfix">
            <span>Directorio Activo de Active Directory</span>
          </div>
          <div class="text item">
            <el-form
              ref="form"
              :model="form"
              label-width="120px"
              v-for="(formulario, fm) of DataResult"
              :key="fm"
            >
              <el-form-item label="Archivo:">
                <el-upload
                  class="upload-demo"
                  :action="'/upload'"
                  name="file[]"
                  :data="{'evento_id':id}"
                  :headers="{ 'X-CSRF-TOKEN': csrf}"
                  :on-preview="handlePreview"
                  :on-remove="handleRemove"
                  :on-success="cargaSuccess"
                  multiple
                  :limit="3"
                  :on-exceed="handleExceed"
                  :file-list="fileList"
                >
                  <el-button size="small" type="primary">Clic para subir archivo</el-button>
                  <div
                    slot="tip"
                    class="el-upload__tip"
                  >Solo archivos jpg/png con un tamaño menor de 500kb</div>
                </el-upload>


              </el-form-item>
            </el-form>
            <el-form label-width="120px">
              <el-form-item>
                <el-button type="primary" @click="onSubmit">Subir</el-button>
                <el-button>Cancel</el-button>
              </el-form-item>
            </el-form>
          </div>
        </el-card> 
      </el-col>
    </el-row>
  </div>
</template>
<script>
export default {
    data() {
    return {
        fileList: [{
          name: 'food.jpeg',
          url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
        }, {
          name: 'food2.jpeg',
          url: 'https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100'
        }],
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
  methods: {
      handleChange(file, fileList) {
        this.fileList = fileList.slice(-3);
      },
    }
}
</script>