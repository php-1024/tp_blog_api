import request from '@/utils/request'

export function getData(params) {
  return request({
    url: '/dashboard/index',
    method: 'post',
    params
  })
}
