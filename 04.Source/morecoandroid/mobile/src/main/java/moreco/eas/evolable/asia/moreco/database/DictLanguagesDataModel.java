package moreco.eas.evolable.asia.moreco.database;

import io.realm.RealmObject;

/**
 * Created by PhanVanTrung on 2016/07/02.
 */
public class DictLanguagesDataModel extends RealmObject {
    private int id;
    private String code;
    private int status;

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getCode() {
        return code;
    }

    public void setCode(String code) {
        this.code = code;
    }


    public int getStatus() {
        return status;
    }

    public void setStatus(int status) {
        this.status = status;
    }


}
