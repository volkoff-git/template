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
                    alert(data.error);
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
    gId: id => document.getElementById(id)
}


let Auth = {
    login: e => {
        e.preventDefault();
        let params = App.getFields(['login', 'password'], 'auth_');
        if(!params['login']){ alert('Логин обязателен для заполнения'); return; }
        if(!params['password']){ alert('пароль обязателен для заполнения'); return; }
        App.send('/auth/performLogin', params, msg => {
            window.location = '/';
        })
    }
}



