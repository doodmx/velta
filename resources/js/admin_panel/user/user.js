import User from '../../models/user';

const user = new User(
    null, //id
    null, //name
    null, //lastname
    null, // membership
    null, //role
    //contact
    {
        proof_residence: null,
        email: null,
        whatsapp: null,
        id_card: null
    });


export default user;
