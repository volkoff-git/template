
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
            App.gId('admin_subpage_container').innerHTML = msg.html;
            App.reinit_tooltip();
        })
    },
    add_new_user: e => {
        e.preventDefault();
        let payload = App.getFields(['login', 'password', 'name'], 'newUser_');
        payload.role = App.getSelect('newUser_role');
        App.send('admin/create_user', payload, msg => {
            Admin.active_tab.click();
        })
    },
    user_edit: (e, id) => {
        e.preventDefault();
        App.send('/admin/show_edit_user_modal', {id}, msg => {
            App.show_modal(msg.html);
        })
    },
    user_toggle_activate: (e, id) => {
        e.preventDefault();
        App.send('admin/toggle_user', {id}, msg => {
            Admin.active_tab.click();
        })
    },
    user_edit_save: (e, id) => {
        e.preventDefault();
        let payload = App.getFields(['login', 'password', 'name'], 'editUser_');
        payload.role = App.getSelect('editUser_role');
        payload.id = id;
        App.send('admin/edit_user', payload, msg => {
            Admin.active_tab.click();
            App.gId('close_modal').click();
        })
    },
    toggle_user_stage: (user_id, event, stage) => {
        let action = 'on';
        let badge = event.target;
        if(badge.classList.contains('bg-blue')) {
            action = 'off';

            badge.classList.add('badge-outline', 'text-blue');
            badge.classList.remove('bg-blue', 'text-blue-fg');
        }
        else {
            badge.classList.remove('badge-outline', 'text-blue');
            badge.classList.add('bg-blue', 'text-blue-fg');
        }
        App.send('/admin/toggle_user_stage', {action, user_id, stage}, msg => {})
    }
}



