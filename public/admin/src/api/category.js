import request from '@/utils/request'

export function getCategory(params) {
  return request({
    url: '/category/category_list',
    method: 'post',
    params
  })
}
