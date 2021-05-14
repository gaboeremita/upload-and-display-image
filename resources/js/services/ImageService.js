import axios from 'axios'

const apiClient = axios.create({
    headers: {
        'content-type': 'multipart/form-data'
    }
})

export default {
    getImages() {
       return JSON.parse(sessionStorage.getItem("images"));
    },
    postImage(data) {
        return apiClient.post('/api/images', data);
    },
    pushImagesToSession(newImages) {

        let images = this.getImages();

        if(images !== null) {
            images.unshift(...newImages);
            sessionStorage.setItem('images', JSON.stringify(images));
        } else {
            sessionStorage.setItem('images', JSON.stringify(newImages));
        }
    }
}
