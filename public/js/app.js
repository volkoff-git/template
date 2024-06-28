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
                    throw new Error('Server error');
                }

                return response.json();

            })
            .then(data => {
                if(data.result !== 'success')
                {
                    alert('error');
                    return;
                }
                callback(data);
            })
            .catch(error => {
                console.info('Server error', error);
            });
    }
}


let Auth = {
    login: e => {
        e.preventDefault();
        App.send('/auth/performLogin', {'ff': '111'}, msg => console.log(msg))
    }
}



