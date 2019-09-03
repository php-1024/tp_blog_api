import request from '@/utils/request'

export function getList(params) {
  return request({
    url: '/articles/list',
    method: 'get',
    params
  })
}

export function addData(params) {
  return request({
    url: '/articles/add',
    method: 'post',
    params
  })
}
