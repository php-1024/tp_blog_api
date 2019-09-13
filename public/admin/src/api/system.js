import request from '@/utils/request'

export function config(params) {
  return request({
    url: '/system/config',
    method: 'post',
    params
  })
}
