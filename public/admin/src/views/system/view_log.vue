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
            <el-tag>
              {{ scope.row.previous }}
            </el-tag>
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
            <el-tag>
              {{ scope.row.full }}
            </el-tag>
          </template>
        </el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script>
import { view_log } from '@/api/system'
export default {
  data() {
    return {
      tableData: [{
        id: 1,
        ip: '192.168.1.1',
        address: '广东省深圳市 电信',
        views: 20,
        date: '2016-05-02'
      }]
    }
  },
  mounted() {
    this.getData()
  },
  methods: {
    getData() {
      view_log().then(res => {
        if (res.code === 200) {
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
