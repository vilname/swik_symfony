const form = document.signUp;

form.onsubmit = function (event) {
    event.preventDefault();

    let formItem = {};

    const data = new FormData(event.target);
    for (const [key, value] of data) {
        formItem[key] = value;
    }

    console.log('formItem', formItem)

    fetch("http://localhost:8081/api/v1/auth/signUp?" + new URLSearchParams(formItem))
        .then( (response) => {
            console.log('response', response);
        });
}
