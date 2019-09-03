<template>
  <div class="dashboard-container">
    <el-row
      :gutter="40"
      class="panel-group"
    >
      <el-col
        :xs="12"
        :sm="12"
        :lg="8"
        class="card-panel-col"
      >
        <div class="card-panel">
          <div class="card-panel-icon-wrapper icon-people">
            <svg-icon
              icon-class="documentation"
              class-name="card-panel-icon"
            />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              文章
            </div>
            <count-to
              :start-val="0"
              :end-val="102400"
              :duration="2600"
              class="card-panel-num"
            />
          </div>
        </div>
      </el-col>
      <el-col
        :xs="12"
        :sm="12"
        :lg="8"
        class="card-panel-col"
      >
        <div class="card-panel">
          <div class="card-panel-icon-wrapper icon-message">
            <svg-icon
              icon-class="message"
              class-name="card-panel-icon"
            />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              评论
            </div>
            <count-to
              :start-val="0"
              :end-val="81212"
              :duration="3000"
              class="card-panel-num"
            />
          </div>
        </div>
      </el-col>
      <el-col
        :xs="12"
        :sm="12"
        :lg="8"
        class="card-panel-col"
      >
        <div class="card-panel">
          <div class="card-panel-icon-wrapper icon-money">
            <svg-icon
              icon-class="documentation"
              class-name="card-panel-icon"
            />
          </div>
          <div class="card-panel-description">
            <div class="card-panel-text">
              微语
            </div>
            <count-to
              :start-val="0"
              :end-val="9280"
              :duration="3200"
              class="card-panel-num"
            />
          </div>
        </div>
      </el-col>
    </el-row>

    <el-row :gutter="8">
      <el-col
        style="padding-right:8px;margin-bottom:30px;"
        :lg="12"
      >
        <el-card class="box-card">
          <div
            slot="header"
            class="clearfix"
          >
            <span>系统信息</span>
          </div>
          <div>
            <span>操作系统： Linux</span>
            <el-divider />
            <span>PHP版本：7.2</span>
            <el-divider />
            <span>服务器域名/IP：127.0.0.1</span>
            <span>PHP版本：7.2</span>
            <el-divider />
            <span>服务器环境：nginx/1.12.2</span>
            <el-divider />
            <span>程序版本：ThinkPHP5.0</span>
          </div>
        </el-card>
      </el-col>
      <el-col
        style="padding-right:8px;margin-bottom:30px;"
        :lg="12"
      >
        <el-table
          :data="list"
          style="width: 100%;padding-top: 15px;"
        >
          <el-table-column
            label="id"
            align="center"
          >
            <template slot-scope="scope">
              {{ scope.row.id }}
            </template>
          </el-table-column>
          <el-table-column
            label="IP"
            align="center"
          >
            <template slot-scope="scope">
              {{ scope.row.ip }}
            </template>
          </el-table-column>
          <el-table-column
            label="实际地址"
            align="center"
          >
            <template slot-scope="{row}">
              <el-tag :type="row.address">
                {{ row.address }}
              </el-tag>
            </template>
          </el-table-column>
          <el-table-column
            label="登录时间"
            align="center"
          >
            <template slot-scope="{row}">
              <el-tag :type="row.created_at">
                {{ row.created_at }}
              </el-tag>
            </template>
          </el-table-column>
        </el-table>
      </el-col>
    </el-row>

  </div>
</template>

<script>
import CountTo from 'vue-count-to'

export default {
  components: {
    CountTo
  },
  data() {
    return {
      list: [{
        id: 1,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 2,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 3,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 4,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 5,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 6,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 7,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 8,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 9,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      },
      {
        id: 10,
        ip: '192.168.1.1',
        address: '广东省深圳市',
        created_at: '2109年08月05日'
      }]
    }
  },
  methods: {
  }
}
</script>

<style lang="scss" scoped>
.dashboard-container {
  padding: 32px;
  background-color: rgb(240, 242, 245);
  position: relative;
}
.panel-group {
  margin-top: 18px;
  .card-panel-col {
    margin-bottom: 32px;
  }
  .card-panel {
    height: 108px;
    cursor: pointer;
    font-size: 12px;
    position: relative;
    overflow: hidden;
    color: #666;
    background: #fff;
    box-shadow: 4px 4px 40px rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.05);
    &:hover {
      .card-panel-icon-wrapper {
        color: #fff;
      }
      .icon-people {
        background: #40c9c6;
      }
      .icon-message {
        background: #36a3f7;
      }
      .icon-money {
        background: #f4516c;
      }
      .icon-shopping {
        background: #34bfa3;
      }
    }
    .icon-people {
      color: #40c9c6;
    }
    .icon-message {
      color: #36a3f7;
    }
    .icon-money {
      color: #f4516c;
    }
    .icon-shopping {
      color: #34bfa3;
    }
    .card-panel-icon-wrapper {
      float: left;
      margin: 14px 0 0 14px;
      padding: 16px;
      transition: all 0.38s ease-out;
      border-radius: 6px;
    }
    .card-panel-icon {
      float: left;
      font-size: 48px;
    }
    .card-panel-description {
      float: right;
      font-weight: bold;
      margin: 26px;
      margin-left: 0px;
      .card-panel-text {
        line-height: 18px;
        color: rgba(0, 0, 0, 0.45);
        font-size: 16px;
        margin-bottom: 12px;
      }
      .card-panel-num {
        font-size: 20px;
      }
    }
  }
}
@media (max-width: 550px) {
  .card-panel-description {
    display: none;
  }
  .card-panel-icon-wrapper {
    float: none !important;
    width: 100%;
    height: 100%;
    margin: 0 !important;
    .svg-icon {
      display: block;
      margin: 14px auto !important;
      float: none !important;
    }
  }
}
</style>
