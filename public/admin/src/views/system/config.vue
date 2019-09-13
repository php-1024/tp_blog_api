<template>
  <el-main>
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>系统设置</span>
      </div>
      <el-form
        ref="form"
        :model="form"
        label-width="120px"
        class="form"
      >
        <el-form-item label="站点标题">
          <el-input v-model="form.site_title" />
        </el-form-item>
        <el-form-item label="站点副标题：">
          <el-input v-model="form.site_description" />
        </el-form-item>
        <el-form-item label="站点地址：">
          <el-input v-model="form.site_url" />
        </el-form-item>
        <el-form-item label="ICP备案号：">
          <el-input v-model="form.icp" />
        </el-form-item>
        <el-form-item label="首页底部信息：">
          <el-input
            v-model="form.footer_info"
            type="textarea"
            rows="10"
          />
        </el-form-item>
        <el-form-item>
          <el-button
            type="primary"
            @click="onSubmit"
          >保存更改</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </el-main>
</template>

<script>
import { config, save_config } from '@/api/system'

export default {
  data() {
    return {
      form: {}
    }
  },
  mounted() {
    this.getData()
  },
  methods: {
    getData() {
      config().then(res => {
        if (res.code === 200) {
          this.form = res.data
        }
      })
    },
    onSubmit() {
      save_config(this.form).then(res => {
        if (res.code === 200) {
          this.$notify({
            title: '提示',
            message: res.message,
            type: 'success'
          })
        }
      })
    }
  }
}
</script>

<style scoped>
.el-main {
  background-color: #e9eef3;
  color: #333;
  padding: 32px;
  position: relative;
}
.form {
  background: #fff;
  padding: 32px;
}
</style>
