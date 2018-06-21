Todos.Todo = DS.Model.extend({
  title: DS.attr('string'),
  isCompleted: DS.attr('boolean')
});

Todos.TodoSerializer = DS.RESTSerializer.extend({
  normalizeResponse(store, primaryModelClass, payload, id, requestType){
payload = { todos:payload };
console.log(payload);
return this._super(...arguments);

}
});

Todos.Todo.FIXTURES = [
 {
   id: 1,
   title: 'Learn Ember.js',
   isCompleted: true
 },
 {
   id: 2,
   title: '...',
   isCompleted: false
 },
 {
   id: 3,
   title: 'Profit!',
   isCompleted: false
 }
];
