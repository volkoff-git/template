let Lead = {
    table_click_handler: id => {
        window.history.pushState({}, '', `/lead/`+id)
        Lead.open(id);
    },
    open: (id) => {
        console.log('loading and opening '+id);
        Lead.modal();
    },
    modal: () => {
        App.gId('leadModalTrigger').click();
    },
    open_modal_from_url: ()=> {
        const url = new URL(document.location);

        let url_arr = url.pathname.split('/');


       // const id = url.searchParams.get("id");
        if (typeof url_arr[2] !== 'undefined') {
            if(url_arr[2] != ''){
                Lead.open(url_arr[2]);
            }
        }
        else{
            App.gId('closeLeadModal').click();
        }
    }
}


Lead.open_modal_from_url()

window.addEventListener('popstate', function() {
    Lead.open_modal_from_url()
});

document.getElementById('leadModal')
    .addEventListener('hide.bs.modal', function (event) {
        window.history.pushState({}, '', `/lead`)
});