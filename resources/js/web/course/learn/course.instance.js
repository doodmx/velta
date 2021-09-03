import Course from '../../../models/course';

const courseObject = new Course(
    null, // id
    'Course Title', // title
    null, // image,
    null, //progress
    null, //Player
    0, //chapterSelected,
    [] //chapters
);

export default courseObject;
