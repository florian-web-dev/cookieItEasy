
// <select name="" id="theme">
//     <option value="light">light</option>
//     <option value="dark">dark</option>
// </select>


let selectTheme = document.querySelector('#theme');
selectTheme.addEventListener('change', function () {

    let optiontheme = selectTheme.value;

    localStorage.setItem('theme', optiontheme)
    if(optiontheme === "dark"){
        document.body.classList.add('bg-dark','text-light')
        document.body.classList.remove('bg-light', 'text-dark')
    }

    if(optiontheme === "light"){
        document.body.classList.remove('bg-dark','text-light')
        document.body.classList.add('bg-light', 'text-dark')
    }

})

if (localStorage.getItem('theme')) {

    let optiontheme = localStorage.getItem('theme')

    if(optiontheme === "dark"){
        document.body.classList.add('bg-dark','text-light')
        document.body.classList.remove('bg-light', 'text-dark')
    }

    if(optiontheme === "light"){
        document.body.classList.remove('bg-dark','text-light')
        document.body.classList.add('bg-light', 'text-dark')
    }
}