const mongoose = require('mongoose')
const Schema = mongoose.Schema

let UserSchema = new Schema({
  nombre: { type: String, required: true },
  usuario: { type: String, required: true},
  password: { type: String, required: true},
  estado: { type: String, required: true, enum: ['Activo', 'Inactivo']}
});

let UserModel = mongoose.model('Usuario', UserSchema);
module.exports = UserModel;

var PrimerUsuario =  new UserModel({
    nombre: 'Sebastian Correa',
    usuario: 'admin',
    password: 'abc1234*',
    estado: 'Activo',
});

