import request from '@/utils/request'

export function config(params) {
  return request({
    url: '/system/config',
    method: 'post',
    params
  })
}

export function save_config(params) {
  return request({
    url: '/system/save_config',
    method: 'post',
    params
  })
}
