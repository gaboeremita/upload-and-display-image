import axios from 'axios'

const apiClient = axios.create({
    headers: {
        'content-type': 'multipart/form-data'
    }
})

export default {
    getImagesUrl() {
       return JSON.parse(sessionStorage.getItem("imagesUrl"));
    },
    postImage(data) {
        return apiClient.post('/api/images', data);
    },
    pushImageToSession(newUrl) {

        let imageUrls = this.getImagesUrl();

        if(imageUrls !== null) {
            imageUrls.push(newUrl);
            sessionStorage.setItem('imagesUrl', JSON.stringify(imageUrls));
        } else {
            sessionStorage.setItem('imagesUrl', JSON.stringify([newUrl]));
        }
    }
}
