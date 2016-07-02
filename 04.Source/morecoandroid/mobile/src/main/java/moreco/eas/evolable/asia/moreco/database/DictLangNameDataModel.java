package moreco.eas.evolable.asia.moreco.database;

import io.realm.RealmObject;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class DictLangNameDataModel extends RealmObject {
    private int id;
    private int dict_language_id;
    private int in_language_id;
    private String name;
    private int data_status;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getdictLanguageId() {
        return dict_language_id;
    }

    public void setdictLanguageId(int dictLanguageId) {
        this.dict_language_id = dictLanguageId;
    }


    public int getInlanguageId() {
        return in_language_id;
    }

    public void setInLanguageId(int inLanguageId) {
        this.in_language_id = inLanguageId;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public int getDataStatus() {
        return data_status;
    }

    public void setDataSatus(int dataStatus) {
        this.data_status = dataStatus;
    }



}
