<template>
  <div class="main">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>栏目列表</span>
      </div>
      <el-table :data="tableData">
        <el-table-column
          prop="id"
          label="ID"
        />
        <el-table-column label="序号">
          <template slot-scope="scope">
            <el-input v-model="scope.row.sort" placeholder="排序" style="width:120px">
              <el-button slot="append" icon="el-icon-sort" />
            </el-input>
          </template>
        </el-table-column>
        <el-table-column label="分类名称">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.name }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="描述">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.desc }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="别名">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.rename }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="文章">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.articles }}
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
        sort: 0,
        name: '随笔日记',
        desc: '前端笔记，网络笔记',
        rename: 'suibi',
        articles: 35
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
