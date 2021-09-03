export default class Tag {

    constructor(id, tag, deleted_at) {

        this.id = id;
        this.tag = tag;
        this.deleted_at = deleted_at;

    }

    setId(id) {
        this.id = id;
    }

    setTag(tag) {
        this.tag = tag;
    }

    setDeletedAt(deleted_at) {
        this.deleted_at = deleted_at;
    }


}
