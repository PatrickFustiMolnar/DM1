tasks = []

#1

def display_menu():
    print("\n" + "="*40)
    print(" Menu de gestion des tâches ".center(40, "="))
    print("1 : Ajouter une tâche")
    print("2 : Afficher les tâches")
    print("3 : Quitter")
    print("4 : Supprimer une tâche (bonus)")
    print("="*40)

while True:
    display_menu()
    choice = input("Choisissez une option : ").strip()
    
    if choice == "1":
        task_name = input("Entrez le nom de la tâche : ").strip()
        if task_name:
            tasks.append(task_name)
            print("✅ Tâche ajoutée avec succès.")
        else:
            print("❌ Le nom de la tâche ne peut pas être vide.")
    
    elif choice == "2":
        if tasks:
            print("\n📋 Liste des tâches :")
            for i, task in enumerate(tasks, 1):
                print(f"{i}. {task}")
        else:
            print("📭 Pas de tâches à afficher.")
    
    elif choice == "3":
        print("👋 Au revoir !")
        break
    
    elif choice == "4":  # Bonus
        if tasks:
            task_num = input("Entrez le numéro de la tâche à supprimer : ").strip()
            if task_num.isdigit() and 1 <= int(task_num) <= len(tasks):
                deleted_task = tasks.pop(int(task_num) - 1)
                print(f"🗑️ Tâche '{deleted_task}' supprimée.")
            else:
                print("❌ Numéro de tâche invalide.")
        else:
            print("📭 Aucune tâche à supprimer.")
    
    else:
        print("❌ Option invalide, veuillez réessayer.")