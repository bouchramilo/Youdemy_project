// tag +++++++
function updateTag(id, nameTag) {
    document.getElementById('id_tag').value = id;
    document.getElementById('nameTag').value = nameTag;

    document.getElementById('updateTagModal').classList.remove('hidden');
}

function closeModalt() {
    document.getElementById('updateTagModal').classList.add('hidden');
}

// categorie +++++++
function updateCategorie(id, nameCategorie) {
    document.getElementById('id_categorie').value = id;
    document.getElementById('nameCategorie').value = nameCategorie;

    document.getElementById('updateCategorieModal').classList.remove('hidden');
}

function closeModalC() {
    document.getElementById('updateCategorieModal').classList.add('hidden');
}