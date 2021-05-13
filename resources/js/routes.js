import UploadImage from "./views/UploadImage";
import ImagesList from "./components/ImagesList";

export default {
    mode: 'history',
    routes: [
        {
            path: '/',
            component: UploadImage,
            name: 'upload-image'
        },
        {
            path: '/images',
            component: ImagesList,
            name: 'images-list'
        }
    ]
}
