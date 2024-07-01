
document.addEventListener("DOMContentLoaded", function() {
    App.gId('default_tab').click();
});


let Admin = {
    active_tab: null,
    select_tab: (e, tab) => {
        e.preventDefault();

        const aTags = document.querySelectorAll("#links-wrapper a");
        aTags.forEach(function(aTag) {
            aTag.classList.remove("active");
        });

        e.target.classList.add('active');
        Admin.active_tab = e.target;

        App.send('/admin/subpage', {tab}, msg => {
            App.gId('admin_subpage_container').innerHTML = msg.html
        })
    },
    add_new_user: e => {
        e.preventDefault();
        let payload = App.getFields(['login', 'password'], 'newUser_');
        payload.role = App.getSelect('newUser_role');
        App.send('admin/create_user', payload, msg => {
            //Admin.active_tab.click();
        })
    }
}