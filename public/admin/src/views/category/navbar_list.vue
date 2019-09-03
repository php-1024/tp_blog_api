<template>
  <div class="main">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span>导航栏列表</span>
      </div>
      <el-table ref="dragTable" :data="list" row-key="id" border fit highlight-current-row style="width: 100%">
        <el-table-column label="排序">
          <template slot-scope="scope">
            <el-input v-model="scope.row.sort" placeholder="排序" style="width:120px">
              <el-button slot="append" icon="el-icon-sort" />
            </el-input>
          </template>
        </el-table-column>
        <el-table-column
          prop="id"
          label="ID"
        />
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
        <el-table-column align="center" label="拖拽" width="80">
          <template slot-scope="{}">
            <svg-icon class="drag-handler" icon-class="drag" />
          </template>
        </el-table-column>
      </el-table>
      <div class="show-d">
        <el-tag>默认顺序:</el-tag> {{ oldList }}
      </div>
      <div class="show-d">
        <el-tag>拖拽后顺序 :</el-tag> {{ newList }}
      </div>
    </el-card>
  </div>
</template>

<script>
import Sortable from 'sortablejs'
export default {
  data() {
    return {
      sortable: null,
      list: [],
      oldList: [],
      newList: []
    }
  },
  created() {
    this.getList()
  },
  methods: {
    async getList() {
      this.list = [{
        id: 1,
        sort: 0,
        name: '随笔日记',
        desc: '前端笔记，网络笔记',
        rename: 'suibi',
        articles: 35
      },
      {
        id: 2,
        sort: 1,
        name: '的哥分类',
        desc: '的哥',
        rename: 'dige',
        articles: 35
      },
      {
        id: 3,
        sort: 2,
        name: 'asasa',
        desc: 'asas',
        rename: 'diasasge',
        articles: 35
      }]
      this.oldList = this.list.map(v => v.id)
      this.newList = this.oldList.slice()
      this.$nextTick(() => {
        this.setSort()
      })
    },
    setSort() {
      const el = this.$refs.dragTable.$el.querySelectorAll('.el-table__body-wrapper > table > tbody')[0]
      this.sortable = Sortable.create(el, {
        ghostClass: 'sortable-ghost', // Class name for the drop placeholder,
        setData: function(dataTransfer) {
          // to avoid Firefox bug
          // Detail see : https://github.com/RubaXa/Sortable/issues/1012
          dataTransfer.setData('Text', '')
        },
        onEnd: evt => {
          const targetRow = this.list.splice(evt.oldIndex, 1)[0]
          this.list.splice(evt.newIndex, 0, targetRow)

          // for show the changes, you can delete in you code
          const tempIndex = this.newList.splice(evt.oldIndex, 1)[0]
          this.newList.splice(evt.newIndex, 0, tempIndex)
        }
      })
    }
  }
}
</script>

<style scoped>
.main {
  padding: 32px;
}
</style>
