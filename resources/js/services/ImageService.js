import axios from 'axios'

const apiClient = axios.create({
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json'
    }
})

export default {
    getImages() {
        return apiClient.get('api/images');
    },
    postImage() {
        return apiClient.post('/images');
    }
}
