const mongoose = require('mongoose')
const Schema = mongoose.Schema

let EventoSchema = new Schema({
  title: { type: String, required: true },
  start: { type: String, required: false },
  end: { type: String, required: false },

});

let EventoModel = mongoose.model('Evento', EventoSchema);
module.exports = EventoModel;