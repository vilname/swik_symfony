const form = document.signUp;

form.onsubmit = function (event) {
    event.preventDefault();

    let formItem = {};

    const data = new FormData(event.target);
    for (const [key, value] of data) {
        formItem[key] = value;
    }

    fetch("http://localhost:8081/api/v1/auth/signUp", {
        method: "post",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formItem)
    })
        .then( (response) => {
            return response.json();
        })
        .then((json) => {
            console.log('json', json)

            document.querySelector('.js-content').innerHTML = json.token;
        });
}
