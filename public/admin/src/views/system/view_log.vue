<template>
  <div class="main">
    <el-card class="box-card">
      <div
        slot="header"
        class="clearfix"
      >
        <span>访客记录</span>
      </div>
      <el-table
        :data="tableData"
        style="width: 100%"
        border
      >
        <el-table-column
          prop="id"
          label="ID"
        />
        <el-table-column label="IP">
          <template slot-scope="scope">
            {{ scope.row.ip }}
          </template>
        </el-table-column>
        <el-table-column label="地址">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.ip_position }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="浏览量">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.num }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="第一次访问时间">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.created_at }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="来源地址">
          <template slot-scope="scope">
            <el-link :href="scope.row.previous" target="_blank" type="primary">{{ scope.row.previous }}</el-link>
          </template>
        </el-table-column>
        <el-table-column label="最后访问时间">
          <template slot-scope="scope">
            <el-tag>
              {{ scope.row.updated_at }}
            </el-tag>
          </template>
        </el-table-column>
        <el-table-column label="最后访问地址">
          <template slot-scope="scope">
            <el-link :href="scope.row.full" target="_blank" type="primary">{{ scope.row.full }}</el-link>
          </template>
        </el-table-column>
      </el-table>
      <!-- 分页 -->
      <pagination
        v-show="total>0"
        :total="total"
        :page.sync="listQuery.page"
        :limit.sync="listQuery.limit"
        @pagination="getData"
      />
    </el-card>
  </div>
</template>

<script>
import { view_log } from '@/api/system'
import Pagination from '@/components/Pagination' // secondary package based on el-pagination
export default {
  components: {
    Pagination
  },
  data() {
    return {
      total: 0,
      listQuery: {
        page: 1,
        limit: 10
      },
      tableData: []
    }
  },
  mounted() {
    this.getData()
  },
  methods: {
    getData() {
      view_log(this.listQuery).then(res => {
        if (res.code === 200) {
          this.total = res.data.total
          this.tableData = res.data.data
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
