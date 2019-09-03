<template>
  <div class="main">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>文章列表</span>
      </div>
      <el-table :data="tableData">
        <el-table-column
          prop="id"
          label="ID"
          width="50"
        />
        <el-table-column label="标题" width="350">
          <template slot-scope="scope">
            {{ scope.row.title }}
          </template>
        </el-table-column>
        <el-table-column label="分类名称">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.category_name }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="浏览量">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.views }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="时间">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.created_at }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="操作">
          <el-button type="primary">编辑</el-button>
          <el-button type="danger">删除</el-button>
        </el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableData: [{
        id: 1,
        title: 'Mysql数据库语句SHOW PROCESSLIST的作用',
        category_name: 'WEB类',
        views: 35,
        created_at: '2019-08-29 10:26:14'
      }, {
        id: 2,
        title: 'tp5使用laravel的dump打印插件',
        category_name: 'Thikphp',
        views: 28,
        created_at: '2019-08-29 10:26:14'
      }, {
        id: 3,
        title: '关于easywchat的sdk缓存问题 Credential "component_verify_ticket" does not exist in cache.',
        category_name: 'Laravel',
        views: 99,
        created_at: '2019-08-29 10:26:14'
      }]
    }
  }
}
</script>

<style scoped>
.main {
  padding: 32px;
}
</style>
