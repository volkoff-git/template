let App = {
    send: (uri, params, callback) => {

        const formData = new FormData();
        for (const key in params) {
            if (Object.hasOwnProperty.call(params, key)) {
                formData.append(key, params[key]);
            }
        }

         fetch(`${uri}`, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Server error. ');
                }

                return response.json();

            })
            .then(data => {
                if(data.result !== 'success')
                {
                    App.toast(data.error);
                    return;
                }
                callback(data);
            })
            .catch(error => {
                console.info('Server error. Response not json', error);
            });
    },
    getFields: (fields, prefix = '') => {
        let values = {};
        fields.forEach(i => {
            values[i] = (App.gId(`${prefix}${i}`)?.value || null) || null;
        })
        return values;
    },
    getSelect: id => {
        let v = document.getElementById(id).value;
        return v===''?null:v;
    },
    gId: id => document.getElementById(id),
    toast: (text, type = 'danger') => {


        App.gId('toast_container').innerHTML += `
<div class="toast mt-2 mb-0 show ${type==='danger'?'text-white':''} bg-${type}" role="alert" aria-live="assertive" aria-atomic="true"
     data-bs-autohide="false" data-bs-toggle="toast" data-bs-animation="true">
    <div class="toast-header">
        <strong class="me-auto">Ошибка</strong><small></small>
        <button type="button" class="ms-2 btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        ${text}
    </div>
</div>
        
        `;
    }
}


let Auth = {
    login: e => {
        e.preventDefault();
        let params = App.getFields(['login', 'password'], 'auth_');
        if(!params['login']){ App.toast('Логин обязателен для заполнения'); return; }
        if(!params['password']){ App.toast('пароль обязателен для заполнения'); return; }
        App.send('/auth/performLogin', params, msg => {
            window.location = '/';
        })
    }
}



