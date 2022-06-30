package view.form;

import controller.MenuController;
import model.Document;
import model.SelectionModel;
import model.ShapeType;
import view.data.ShapeDataViewInterface;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;

public class MenuView extends JMenuBar {
    private MenuController controller;

    public MenuView(Document document, ShapeDataViewInterface dataView, SelectionModel selectionModel) {
        super();
        controller = new MenuController(document, dataView, selectionModel);

        initComponents();
    }

    private void initComponents() {
        this.initMenuFile();
        this.initMenuEdit();
        this.initMenuHome();
        this.initMenuInsert();
        this.initMenuView();
        this.initMenuFormat();
    }

    private void initMenuFile() {
        JMenu menuFile = new JMenu("File");

        JMenuItem itemExit = new JMenuItem("Exit");
        itemExit.setMnemonic(KeyEvent.VK_Q);
        itemExit.setAccelerator(KeyStroke.getKeyStroke(KeyEvent.VK_Q, ActionEvent.CTRL_MASK));
        itemExit.setToolTipText("Exit application");
        itemExit.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent event) {
                controller.onExit();
            }
        });

        menuFile.add(itemExit);

        this.add(menuFile);
    }

    private void initMenuEdit() {
        JMenu menuEdit = new JMenu("Edit");

        JMenuItem itemDel = new JMenuItem("Del");
        itemDel.setMnemonic(KeyEvent.VK_DELETE);
        itemDel.setAccelerator(KeyStroke.getKeyStroke((char) KeyEvent.VK_DELETE));
        itemDel.setToolTipText("Delete selected shapes");
        itemDel.addActionListener(new ActionListener() {
            public void actionPerformed(ActionEvent event) {
                controller.onDelete();
            }
        });

        menuEdit.add(itemDel);

        this.add(menuEdit);
    }

    private void initMenuHome() {
        JMenu menuHome = new JMenu("Home");
        this.add(menuHome);
    }

    private void initMenuInsert() {
        JMenu menuInsert = new JMenu("Insert");

        JMenuItem itemRectangle = new JMenuItem("Rectangle");
        itemRectangle.setToolTipText("Insert Rectangle");
        itemRectangle.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.RECTANGLE);
            }
        });

        JMenuItem itemTriangle = new JMenuItem("Triangle");
        itemTriangle.setToolTipText("Insert Triangle");
        itemTriangle.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.TRIANGLE);
            }
        });

        JMenuItem itemEllipse = new JMenuItem("Ellipse");
        itemEllipse.setToolTipText("Insert Ellipse");
        itemEllipse.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                controller.onAddShape(ShapeType.ELLIPSE);
            }
        });

        menuInsert.add(itemRectangle);
        menuInsert.add(itemTriangle);
        menuInsert.add(itemEllipse);

        this.add(menuInsert);
    }

    private void initMenuView() {
        JMenu menuView = new JMenu("View");
        this.add(menuView);
    }

    private void initMenuFormat() {
        JMenu menuFormat = new JMenu("Format");
        this.add(menuFormat);
    }
}
