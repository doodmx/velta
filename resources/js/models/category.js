export default class Category {

    constructor(id, category, deleted_at) {

        this.id = id;
        this.category = category;
        this.deleted_at = deleted_at;

    }

    setId(id) {
        this.id = id;
    }

    setCategory(category) {
        this.category = category;
    }

    setDeletedAt(deleted_at) {
        this.deleted_at = deleted_at;
    }


}
