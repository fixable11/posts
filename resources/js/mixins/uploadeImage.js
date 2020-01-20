export default {
    methods: {
        uploadImage() {
            let file = document.querySelector('input[type=file]').files[0];
            let reader = new FileReader();
            reader.onload = (e) => {
                this.formData.image = e.target.result
            };
            reader.onerror = error => console.log(error);
            reader.readAsDataURL(file);
        }
    }
}
