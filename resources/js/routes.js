export const routes = [{
        path: '/',
        component: require('./pages/Dashboard.vue').default,
        meta: { requiresAuth: true }
    }, {
        path: '/investment',
        component: require('./pages/Invest.vue').default,
        meta: { requiresAuth: true }
    },
    {
        path: '/account',
        component: require('./pages/Account.vue').default,
        meta: { requiresAuth: true },
        children: [{
                path: 'account-settings',
                component: require('./subpages/AccountSettings.vue').default,
            },
            {
                path: 'bank-settings',
                component: require('./subpages/BankSettings.vue').default,
            },
            {
                name: 'profile',
                path: 'profile-settings',
                component: require('./subpages/ProfileSettings.vue').default,
            },
            {
                name: 'password',
                path: 'password-settings',
                component: require('./subpages/PasswordSettings.vue').default,
            },
            {
                name: 'update-bank',
                path: 'update-bank',
                component: require('./subpages/UpdateBank.vue').default,
            }
        ]
    },
    {
        path: '/contact',
        component: require('./subpages/ContactUs.vue').default,
        meta: { requiresAuth: true }
    },
    {
        path: '/wallet',
        component: require('./subpages/MyWallet.vue').default,
        meta: { requiresAuth: true },
        children: [{
                path: 'deposit',
                component: require('./subpages/Deposit.vue').default,
            },
            {
                path: 'withdraw',
                component: require('./subpages/Withdraw.vue').default,
            }
        ]
    },
    {
        path: '/notifications',
        component: require('./pages/Notifications.vue').default,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        component: require('./pages/auth/Login.vue').default,
        meta: { guest: true }
    },
];