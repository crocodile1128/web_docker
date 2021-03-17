class AddUsersTable < ActiveRecord::Migration
  def up
    create_table :users do |t|
      t.string :name
      t.text :description
      t.string :token
      t.boolean :is_admin, default: 1

      t.timestamps
    end
  end

  def down
    drop_table :users
  end
end
