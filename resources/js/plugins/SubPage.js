const SubPage = {
    install(Vue, options) {
        Vue.mixin({
            methods: {
                openSubPage(subPage) {
                    Fire.$emit("open" + subPage)
                }
            }
        })
    }

}
export default SubPage
// if (typeof window !== 'undefined' && window.Vue) {
//     window.Vue.use(SubPage)
// }