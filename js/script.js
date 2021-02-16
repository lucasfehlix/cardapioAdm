document.getElementById('btn-add').addEventListener('click', () => {
    document.getElementById('column-list').classList.remove('col-md-12')
    document.getElementById('column-list').style.transition = 'all 0.5s'
    document.getElementById('column-list').classList.add('col-md-8')
    setTimeout(() => {
        document.getElementById('column-form').classList.remove('d-none')
    },500)
})
document.getElementById('btn-cancel').addEventListener('click', () => {
    document.getElementById('column-list').classList.remove('col-md-8')
    document.getElementById('column-list').classList.add('col-md-12')
    document.getElementById('column-form').classList.add('d-none')
})
function alertSuccess(message) {
    document.getElementById('alert').classList.add("alert-success")
    document.getElementById('alert').classList.remove("fade")
    document.getElementById('alert').innerHTML = message
    setTimeout(
        function () { 
            document.getElementById('alert').classList.add("fade")
            document.getElementById('alert').classList.remove("alert-success")
        }, 5000
    )
}
function alertCaution(message) {
    document.getElementById('alert').classList.add("alert-warning")
    document.getElementById('alert').classList.remove("fade")
    document.getElementById('alert').innerHTML = message
    setTimeout(
        function () { 
            document.getElementById('alert').classList.add("fade")
            document.getElementById('alert').classList.remove("alert-warning")
        }, 5000
    )
} 
function alertFailure(message) {
    document.getElementById('alert').classList.add("alert-danger")
    document.getElementById('alert').classList.remove("fade")
    document.getElementById('alert').innerHTML = message
    setTimeout(
        function () { 
            document.getElementById('alert').classList.add("fade")
            document.getElementById('alert').classList.remove("alert-danger")
        }, 5000
    )
}
function modal(btnValue) {
    document.getElementById('modal-body').innerHTML = `
        <div id="content-model-body" value="${btnValue}">
            Deseja realmente excluir o cardápio <strong>${btnValue}</strong>?
        </div>
    `
    document.getElementById('modal-footer').innerHTML = `
        <a class="btn btn-primary" href="index.php?menudelete=${btnValue}">Sim</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
    `
}