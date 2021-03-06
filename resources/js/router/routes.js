function page(path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },
  {
    path: '/transactions',
    component: page('transactions/index.vue'),
    children: [
      { path: '', redirect: { name: 'transactions.income' } },
      { path: 'income', name: 'transactions.income', component: page('transactions/income.vue') },
      { path: 'outcome', name: 'transactions.outcome', component: page('transactions/outcome.vue') }
    ]
  },
  {
    path: '/admin',
    component: page('admin/index.vue'),
    children: [
      { path: '', redirect: { name: 'admin.transactions' } },
      { path: 'income', name: 'admin.transactions', component: page('admin/transactions.vue') },


    ]
  },
    {
    path: '/user',
    component: page('user/index.vue'),
    children: [
      { path: '', redirect: { name: 'user.transactions' } },
      { path: 'income', name: 'user.transactions', component: page('user/transactions.vue') },
      { path: 'create-transaction', name: 'user.create_transaction', component: page('user/create.vue') },


    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
