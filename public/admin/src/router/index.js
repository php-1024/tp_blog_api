import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

/* Layout */
import Layout from '@/layout'

/**
 * Note: sub-menu only appear when route children.length >= 1
 * Detail see: https://panjiachen.github.io/vue-element-admin-site/guide/essentials/router-and-nav.html
 *
 * hidden: true                   if set true, item will not show in the sidebar(default is false)
 * alwaysShow: true               if set true, will always show the root menu
 *                                if not set alwaysShow, when item has more than one children route,
 *                                it will becomes nested mode, otherwise not show the root menu
 * redirect: noRedirect           if set noRedirect will no redirect in the breadcrumb
 * name:'router-name'             the name is used by <keep-alive> (must set!!!)
 * meta : {
    roles: ['admin','editor']    control the page roles (you can set multiple roles)
    title: 'title'               the name show in sidebar and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar
    breadcrumb: false            if set false, the item will hidden in breadcrumb(default is true)
    activeMenu: '/example/list'  if set path, the sidebar will highlight the path you set
  }
 */

/**
 * constantRoutes
 * a base page that does not have permission requirements
 * all roles can be accessed
 */
export const constantRoutes = [
  {
    path: '/login',
    component: () => import('@/views/login/index'),
    hidden: true
  },

  {
    path: '/404',
    component: () => import('@/views/404'),
    hidden: true
  },

  {
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    children: [{
      path: 'dashboard',
      name: '系统首页',
      component: () => import('@/views/dashboard/index'),
      meta: { title: '系统首页', icon: 'dashboard' }
    }]
  },
  {
    path: '/system',
    component: Layout,
    redirect: '/system/config',
    name: 'system',
    meta: { title: '系统管理', icon: 'setting' },
    children: [
      {
        path: 'config',
        name: 'config',
        component: () => import('@/views/system/config'),
        meta: { title: '系统设置' }
      },
      {
        path: 'view_log',
        name: 'view_log',
        component: () => import('@/views/system/view_log'),
        meta: { title: '访客记录' }
      }
    ]
  },
  {
    path: '/category',
    component: Layout,
    redirect: '/category/category_list',
    name: 'category',
    meta: { title: '栏目管理', icon: 'nested' },
    children: [
      {
        path: 'category_list',
        name: 'category_list',
        component: () => import('@/views/category/category_list'),
        meta: { title: '栏目列表' }
      },
      {
        path: 'navbar_list',
        name: 'navbar_list',
        component: () => import('@/views/category/navbar_list'),
        meta: { title: '导航列表' }
      }
    ]
  },
  {
    path: '/articles',
    component: Layout,
    redirect: '/articles/list',
    name: 'category',
    meta: { title: '文章管理', icon: 'form' },
    children: [
      {
        path: 'list',
        name: 'list',
        component: () => import('@/views/articles/list'),
        meta: { title: '文章列表' }
      },
      {
        path: 'add',
        name: 'add',
        component: () => import('@/views/articles/add'),
        meta: { title: '撰写文章' }
      },
      {
        path: 'edit',
        name: 'edit',
        component: () => import('@/views/articles/edit'),
        meta: { title: '编辑文章' },
        hidden: true
      }
    ]
  },

  {
    path: '/serve',
    component: Layout,
    redirect: '/serve/link_list',
    name: 'serve',
    meta: { title: '云拓展', icon: 'international' },
    children: [
      {
        path: 'link_list',
        name: 'link_list',
        component: () => import('@/views/serve/link_list'),
        meta: { title: '友情链接' }
      },
      {
        path: 'tag_list',
        name: 'tag_list',
        component: () => import('@/views/serve/tag_list'),
        meta: { title: '标签列表' }
      },
      {
        path: 'comment_list',
        name: 'comment_list',
        component: () => import('@/views/serve/comment_list'),
        meta: { title: '评论列表' }
      },
      {
        path: 'twitter_list',
        name: 'twitter_list',
        component: () => import('@/views/serve/twitter_list'),
        meta: { title: '说说列表' }
      }
    ]
  },

  {
    path: 'external-link',
    component: Layout,
    children: [
      {
        path: 'http://blog.54zm.com/',
        meta: { title: '访问首页', icon: 'link' }
      }
    ]
  },

  // 404 page must be placed at the end !!!
  { path: '*', redirect: '/404', hidden: true }
]

const createRouter = () => new Router({
  // mode: 'history', // require service support
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRoutes
})

const router = createRouter()

// Detail see: https://github.com/vuejs/vue-router/issues/1234#issuecomment-357941465
export function resetRouter() {
  const newRouter = createRouter()
  router.matcher = newRouter.matcher // reset router
}

export default router
